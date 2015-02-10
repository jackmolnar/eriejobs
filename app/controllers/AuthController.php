<?php

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
    }

    /**
     * Get seeker signup view
     *
     * @return \Illuminate\View\View
     */
    public function getSeekerSignup()
    {
        return View::make('auth.signup');
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
     * Get seeker login view
     *
     * @return \Illuminate\View\View
     */
    public function getSeekerLogin()
    {
        return View::make('auth.login');
    }

    /**
     * Login Seeker
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postSeekerLogin()
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

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/');
    }


}
