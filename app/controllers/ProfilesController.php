<?php

use EriePaJobs\JobSeekers\UpdateSeekerInfoCommand;
use EriePaJobs\JobSeekers\UpdateSeekerInfoValidator;
use EriePaJobs\JobSeekers\UpdateSeekerNotificationsCommand;
use EriePaJobs\JobSeekers\UpdateSeekerNotificationSettingsCommand;
use EriePaJobs\Resumes\DeletePermanentResumeCommand;
use EriePaJobs\Users\DeleteAccountCommand;
use EriePaJobs\Users\UserRepository;

class ProfilesController extends \BaseController {

    /**
     * @var UserRepository
     */
    protected $userRepo;

    function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
        View::share('user', $this->userRepo->authedUser());
        $this->beforeFilter('auth');
    }


    /**
	 * Display a listing of the resource.
	 * GET /profiles
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = $this->userRepo->authedUser();

        if(isset($user->resume->path) && $user->resume->path != '')
        {
            $user->filename = $this->userRepo->getResumeFileName();
        }

        if($user->subscribed())
        {
            $user->listingsLeft = $this->userRepo->remainingSubscribedJobs();
        }

		return View::make('profile.index', ['user' => $user]);
	}

    /**
     * Show the form for editing the specified resource.
     * GET /profiles/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /profiles/{id}/edit
	 *
	 * @return Response
	 */
	public function edit_info()
	{
        return View::make('profile.edit_info');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /profiles/{id}/edit
	 *
	 * @return Response
	 */
	public function edit_notifications()
	{
        return View::make('profile.edit_notifications');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /profiles/{id}/edit
	 *
	 * @return Response
	 */
	public function edit_notification_settings()
	{
        return View::make('profile.edit_notification_settings');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /profiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /update_info/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update_info($id)
	{
		$updateInfoValidator = new UpdateSeekerInfoValidator(Input::all());
        $valid = $updateInfoValidator->execute();

        if($valid['status'])
        {
            $updateSeekerInfoCommand = new UpdateSeekerInfoCommand(Input::all(), $id);
            $updateSeekerInfoCommand->execute();
            return Redirect::action('ProfilesController@index')->with('success', 'Your info has been updated.');
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);
	}

    /**
     * Update notification terms
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * PUT /edit-notifications/{id}
     */
    public function update_notifications($id)
    {
        $updateSeekerNotificationsCommand = new UpdateSeekerNotificationsCommand(Input::all());
        $updateSeekerNotificationsCommand->execute();
        return Redirect::action('ProfilesController@index')->with('success', 'Your email notifications have been updated.');
    }

    /**
     * Update the email and sms notifications
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * PUT /edit-notification-settings/{id}
     */
    public function update_notification_settings($user_id)
    {
        $updateSeekerNotificationSettingsCommand = new UpdateSeekerNotificationSettingsCommand($user_id, Input::all());
        $updateSeekerNotificationSettingsCommand->execute();
        return Redirect::action('ProfilesController@index')->with('success', 'Your notification settings have been updated.');
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /profiles/{id}
	 *
	 * @param  int  $user_id
	 * @return Response
	 */
	public function destroy($user_id)
	{
        $authedUser = $this->userRepo->authedUser();

        if($authedUser->id == $user_id)
        {
            $deleteAccountCommand = new DeleteAccountCommand($user_id);
            $result = $deleteAccountCommand->execute();
        }

        if(isset($result)) {
            return Redirect::action('PagesController@home');
        } else {
            return Redirect::action('ProfilesController@index')->with('error', 'You are unable to delete that account.');
        }
	}

    /**
     * Delete a users permanent resume
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy_resume()
    {
        $user = $this->userRepo->authedUser();
        $deletePermanentResumeCommand = new DeletePermanentResumeCommand($user);
        $deletePermanentResumeCommand->execute();
        return Redirect::action('ProfilesController@index')->with('success', 'Resume Deleted');
    }

}