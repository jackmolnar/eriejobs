<?php

use EriePaJobs\Auth\RestoreUserAccountCommand;
use EriePaJobs\Auth\SendRestoreUserAccountEmailCommand;
use EriePaJobs\JobSeekers\SubscribeNewJobSeekerCommand;
use EriePaJobs\JobSeekers\SubscribeNewJobSeekerValidator;
use EriePaJobs\Auth\LoginUserCommand;
use EriePaJobs\Auth\LoginValidator;
use EriePaJobs\Recruiters\SubscribeNewRecruiterCommand;
use EriePaJobs\Recruiters\SubscribeNewRecruiterValidator;

class AuthController extends \BaseController {


    public function __construct( )
    {
        $this->beforeFilter('loggedin',['except' => 'logout']);
        $this->beforeFilter('deletedUser', ['only' => ['postSeekerSignup', 'postRecruiterSignup']]);
    }

    /**
     * Get login view
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return View::make('Auth/login');
    }

    /**
     * Login Seeker
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $loginValidator = new LoginValidator(Input::all());
        $valid = $loginValidator->execute();

        if($valid['status'])
        {
            $loginUser = new LoginUserCommand(Input::all());
            $login = $loginUser->execute();

            if($login){
                return Redirect::intended('/profile')->with('user_login', true);
            } else {
                return Redirect::back()->withInput()->withErrors([null, 'Password does not match email address.']);
            }

        } else {
            return Redirect::back()->withInput()->withErrors($valid['errors']);
        }
    }

    /**
     * Get seeker signup view
     *
     * @return \Illuminate\View\View
     */
    public function getSeekerSignup()
    {
        return View::make('Auth/signup');
    }


    /**
     * Subscribe seeker and redirect
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postSeekerSignup()
    {
        $newSeekerValidator = new SubscribeNewJobSeekerValidator(Input::all());
        $valid = $newSeekerValidator->execute();

        if($valid['status'])
        {
            $subscribeNewJobSeeker = new SubscribeNewJobSeekerCommand(Input::all());
            $user = $subscribeNewJobSeeker->execute();

            Auth::login($user);

            return Redirect::to('/profile');
        }
        return Redirect::back()->withInput()->withErrors($valid['errors']);
    }

    /**
     * Get recruiter signup view
     *
     * @return \Illuminate\View\View
     */
    public function getRecruiterSignup()
    {
        return View::make('auth.recruiter_signup');
    }


    /**
     * Subscribe the new recruiter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRecruiterSignup()
    {
        $newRecruiterValidator = new SubscribeNewRecruiterValidator(Input::all());
        $valid = $newRecruiterValidator->execute();

        if($valid['status']){
            //need to edit command
            $subscribeNewRecruiter = new SubscribeNewRecruiterCommand(Input::all());
            $user = $subscribeNewRecruiter->execute();

            Auth::login($user);

            return Redirect::to('/profile');
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);
    }

    /**
     * Logout the user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Get the restore user view
     * @return \Illuminate\View\View
     */
    public function getRestoreUser()
    {
        return View::make('Auth.restore_user', ['email' => Input::get('email')]);
    }

    /**
     * Send restore user confirmation email
     * @return \Illuminate\View\View
     */
    public function sendRestoreUser()
    {
        $restoreUserAccountEmail = new SendRestoreUserAccountEmailCommand(Input::get('email'));
        $result = $restoreUserAccountEmail->execute();

        $result = $result ? 'We have sent you a confirmation email to restore your account. Click the link in the email to confirm you want to restore your account.' : 'An error occurred. There is no deleted user with that email to restore.';

        return View::make('Auth.restore_user_sent', ['result' => $result]);
    }

    /**
     * User account restore confirmed from email
     * @return \Illuminate\View\View
     */
    public function restoreUserConfirmed()
    {
        $restoreUserAccountCommand = new RestoreUserAccountCommand(Input::get('user_id'));
        $result = $restoreUserAccountCommand->execute();
        $result = $result ? 'Your account has been restored, and you are logged in.' : 'An error occurred. There is no deleted user with that email to restore.';
        return View::make('Auth.restore_user_sent', ['result' => $result]);
    }
}
