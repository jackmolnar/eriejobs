<?php

use EriePaJobs\Notifications\CreateNotificationCommand;

class NotificationsController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /notifications/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$searchTerm = Input::get('searchTerm');

        $createNotification = new CreateNotificationCommand($searchTerm);

        $result = $createNotification->execute();

        $result = $result ? "You're Signed Up!" : "You're Already Signed Up for This Term!";

        return $result;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /notifications
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /notifications/{id}
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
	 * GET /notifications/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /notifications/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /notifications/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}