<?php

use EriePaJobs\JobSeekers\UpdateSeekerInfoCommand;
use EriePaJobs\JobSeekers\UpdateSeekerInfoValidator;
use EriePaJobs\JobSeekers\UpdateSeekerNotificationsCommand;
use EriePaJobs\Users\DeleteAccountCommand;

class ProfilesController extends \BaseController {

    function __construct()
    {
        View::share('user', Auth::user());
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
		return View::make('profile.index');
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

    public function update_notifications($id)
    {
        $updateSeekerNotificationsCommand = new UpdateSeekerNotificationsCommand(Input::all());
        $updateSeekerNotificationsCommand->execute();
        return Redirect::action('ProfilesController@index')->with('success', 'Your email notifications have been updated.');
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
        $authedUser = Auth::user();

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

}