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
            return Redirect::action('ApplicationsController@applicationSent', [$job_id]);
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);
    }

	/**
	 * Application sent
	 * @param $job_id
	 * @return \Illuminate\View\View
     */
	public function applicationSent($job_id)
    {
		$job = $this->jobRepo->getJobById($job_id);
        return View::make('applications.sent', ['job' => $job]);
    }

}