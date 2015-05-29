<?php

use EriePaJobs\Jobs\JobsRepository;

class FeedController extends \BaseController {

	/**
	 * @var JobsRepository
	 */
	private $jobRepo;

	function __construct(JobsRepository $jobRepo)
	{
		$this->jobRepo = $jobRepo;
	}


	/**
	 * Display a listing of the resource.
	 * GET /feed
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}



	/**
	 * Display the specified resource.
	 * GET /feed/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$result = $this->jobRepo->allActiveJobs();

		return Response::view('feeds.'.$id, ['jobs' => $result])->header('Content-Type', 'application/xml');

//		return View::make('feeds.feed', ['jobs' => $result]);
	}



}