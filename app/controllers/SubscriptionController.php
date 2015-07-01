<?php

use EriePaJobs\Users\UserRepository;

class SubscriptionController extends \BaseController {

	function __construct(UserRepository $userRepo)
	{
		$this->userRepo = $userRepo;
		View::share('user', $this->userRepo->authedUser());
	}

	/**
	 * Display a listing of the resource.
	 * GET /subscription
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /subscription/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$subscriptions = Config::get('billing.subscriptions');
		return View::make('subscription.create', ['subscriptions' => $subscriptions] );
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /subscription
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /subscription/{id}
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
	 * GET /subscription/{id}/edit
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
	 * PUT /subscription/{id}
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
	 * DELETE /subscription/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}