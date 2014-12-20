<?php

use EriePaJobs\JobSeekers\UpdateSeekerInfoCommand;
use EriePaJobs\JobSeekers\UpdateSeekerInfoValidator;

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
	 * Show the form for creating a new resource.
	 * GET /profiles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /profiles
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /profiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	 * Remove the specified resource from storage.
	 * DELETE /profiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}