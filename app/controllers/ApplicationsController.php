<?php

use EriePaJobs\Applications\SendNewApplicationCommand;
use EriePaJobs\Applications\SendNewApplicationValidator;
use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Resumes\PermanentResumeValidator;
use EriePaJobs\Resumes\StorePermanentResumeCommand;
use EriePaJobs\Users\UserRepository;

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
        $userRepo = new UserRepository;
        $user = $userRepo->authedUser();

        //get users default resume file name
        if(isset($user->resume->path) && $user->resume->path != '')
        {
            $user->filename = $userRepo->getResumeFileName();
        }

        $job = $this->jobRepo->getJobById($job_id);

		return View::make('applications.create', ['job' => $job, 'user' => $user]);
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

            $newApplicationCommand = new SendNewApplicationCommand(Input::all(), $job);
            $newApplicationCommand->execute();
            return Redirect::action('ApplicationsController@applicationSent', [$job_id]);
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);
    }

    /**
     * Store permanent resume
     * @return string
     */
    public function storePermanent()
    {
        $newApplicationValidator = new PermanentResumeValidator(Input::all());
        $valid = $newApplicationValidator->execute();

        if($valid['status'])
        {
            $storePermanentResumeCommand = new StorePermanentResumeCommand(Input::file('resume'));
            $storePermanentResumeCommand->execute();
            return 'Resume Uploaded!';
        }
        return($valid['errors']);
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