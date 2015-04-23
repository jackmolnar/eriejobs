<?php

use EriePaJobs\Categories\CategoryRepository;
use EriePaJobs\Jobs\DeleteJobCommand;
use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Payments\PaymentRepository;
use EriePaJobs\Jobs\PostNewJobValidator;
use EriePaJobs\Jobs\PostNewJobCommand;
use EriePaJobs\Jobs\UpdateJobValidator;
use EriePaJobs\Jobs\UpdateJobCommand;

class JobsController extends \BaseController {

    /**
     * @var JobsRepository
     */
    private $jobRepo;
    /**
     * @var PaymentRepository
     */
    private $paymentRepo;
    /**
     * @var CategoryRepository
     */
    private $categoryRepo;

    function __construct(JobsRepository $jobRepo, PaymentRepository $paymentRepo, CategoryRepository $categoryRepo)
    {
        $share_array = [
            'states'        => State::dropdownarray(),
            'types'         => Type::dropdownarray(),
            'career_levels' => CareerLevel::dropdownarray(),
            'categories'    => Category::dropdownarray(),
            'user'          => Auth::user(),
            'payment'       => Job::paymentDropDownArray()
        ];
        View::share($share_array);

        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->beforeFilter('jobAuthor', ['only' => ['edit', 'update']]);

        $this->jobRepo = $jobRepo;
        $this->paymentRepo = $paymentRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        return Redirect::action('SearchController@index');
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /jobs/create
	 *
	 * @return Response
	 */
	public function create()
	{
        if(Session::has('pending_job'))
        {
            return View::make('jobs.create', ['job' => Session::get('pending_job'), 'billing' => \Config::get('billing')]);
        }
		return View::make('jobs.create', ['billing' => \Config::get('billing')]);
	}

	/**
	 * Validate the job listing, begin the job listing process
	 * POST /jobs
	 *
	 * @return Response
	 */
	public function store()
	{
		$newJobValidator = new PostNewJobValidator(Input::all());
        $valid = $newJobValidator->execute('create');

        if($valid['status'])
        {
            $newJobCommand = new PostNewJobCommand(Input::all());
            $newJobCommand->execute('create');
            return Redirect::action('JobsController@review');
        }
        return Redirect::back()->withInput()->withErrors($valid['errors']);
	}

    /**
     * Review job listing
     *
     * @return \Illuminate\View\View
     */
    public function review()
    {
        $pending_job = Session::get('pending_job');
        $cost = $this->jobRepo->getCostFromExpireDate($pending_job->expire);
        $length = $this->jobRepo->getLengthFromExpireDate($pending_job->expire)." Day Job Listing";

        return View::make('jobs.review', ['pending_job' => $pending_job, 'cost' => $cost, 'length' => $length]);
    }

    /**
     * Process the payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment()
    {
        $newJobCommand = new PostNewJobCommand(Input::all());
        $result = $newJobCommand->execute('bill');

        if(!$result['status'])
        {
            return Redirect::back()->with('error', $result['message']);
        }
        return Redirect::action('JobsController@thankyou');
    }

    /**
     * Display thank you page
     * @return \Illuminate\View\View
     */
    public function thankyou()
    {
        // remove pending job from session
        Session::remove('pending_job');

        $charge = Session::get('charge');
        return View::make('jobs.thankyou', ['charge' => $charge]);
    }

    /**
	 * Display the specified resource.
	 * GET /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $job = $this->jobRepo->getJobById($id);
        $categories = $this->categoryRepo->getAllCategories();

        if(empty($job) || !$job->active)
        {
            return View::make('jobs.not_found');
        }

        return View::make('jobs.show', ['job' => $job, 'categories' => $categories]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /jobs/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $job = $this->jobRepo->getJobById($id);
        return View::make('jobs.edit', ['job' => $job]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $updateJobValidator = new UpdateJobValidator(Input::all());
        $valid = $updateJobValidator->execute();

        if($valid['status'])
        {
            $updateJobCommand = new UpdateJobCommand(Input::all(), $id);
            $updateJobCommand->execute();
            return Redirect::action('JobsController@show', ['id' => $id])->with('success', 'Job has been updated!');
        }

        return Redirect::back()->withInput()->withErrors($valid['errors']);
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /jobs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deleteJobCommand = new DeleteJobCommand($id);
        $result = $deleteJobCommand->execute();
        if($result['status'])
        {
            return Redirect::action('ProfilesController@index')->with('success', $result['message']);
        }
        return Redirect::back()->withErrors($result['message']);
	}

    /**
     * method to activate and deactivate jobs
     * @return string
     */
    public function active()
    {
        $active = Input::get('active');
        $id = Input::get('jobid');

        if($active == 0)
        {
            $this->jobRepo->deactivateJob($id);
            return "Deactivated";
        }

        $this->jobRepo->activateJob($id);
        return "Activated";
    }
}