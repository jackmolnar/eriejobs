<?php

use EriePaJobs\Applications\SendNewApplicationCommand;
use EriePaJobs\Applications\SendNewApplicationValidator;
use EriePaJobs\Jobs\JobsRepository;

class ApplicationsController extends \BaseController {

    /**
     * @var JobsRepository
     */
    private $jobRepo;

    function __construct(JobsRepository $jobRepo)
    {
        $this->beforeFilter('auth');
        $this->jobRepo = $jobRepo;
    }

    /**
	 * Display a listing of the resource.
	 * GET /applications
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /applications/create
	 *
	 * @return Response
	 */
	public function create($job_id)
	{
        $job = $this->jobRepo->getJobById($job_id);
		return View::make('applications.create', ['job' => $job]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /applications
	 *
	 * @return Response
	 */
	public function store($job_id)
	{
		$newApplicationValidator = new SendNewApplicationValidator(Input::all());
        $valid = $newApplicationValidator->execute();

        if($valid['status'])
        {
            $job = $this->jobRepo->getJobById($job_id);
            $newApplicationCommand = new SendNewApplicationCommand(Input::all(), Input::file('resume'), $job);
            $newApplicationCommand->execute();
            return Redirect::action('ApplicationsController@sent', [$job_id])->with('success', 'Your Application Has Been Sent!');
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);
    }

	/**
	 * Display the specified resource.
	 * GET /applications/{id}
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
	 * GET /applications/{id}/edit
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
	 * PUT /applications/{id}
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
	 * DELETE /applications/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function sent($job_id)
    {
        $job = $this->jobRepo->getJobById($job_id);
        dd($job);
        return View::make('applications.sent', ['job' => $job]);
    }

}