<?php

use EriePaJobs\Categories\CategoryRepository;
use EriePaJobs\Jobs\DeleteJobCommand;
use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Payments\PaymentRepository;
use EriePaJobs\Jobs\PostNewJobValidator;
use EriePaJobs\Jobs\PostNewJobCommand;
use EriePaJobs\Jobs\UpdateJobValidator;
use EriePaJobs\Jobs\UpdateJobCommand;
use EriePaJobs\Users\UserRepository;

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
    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * Define constants
     */
    const EPJ = 1;

    const ER = 2;

    const EPJ_ER = 3;

    function __construct(
        JobsRepository $jobRepo,
        PaymentRepository $paymentRepo,
        CategoryRepository $categoryRepo,
        UserRepository $userRepo)
    {
        $this->jobRepo = $jobRepo;
        $this->paymentRepo = $paymentRepo;
        $this->categoryRepo = $categoryRepo;
        $this->userRepo = $userRepo;

        // get number of remaining listings for subscribed user
        $listingsLeft = $this->userRepo->remainingSubscribedJobs();

        // get proper payment dropdown array
        $payment = $this->jobRepo->paymentDropDownArray($listingsLeft);

        // get logged user
        $user = $this->userRepo->authedUser();

        // free or not
        $billing = \Config::get('billing');

        $share_array = [
            'states'        => State::dropdownarray(),
            'types'         => Type::dropdownarray(),
            'career_levels' => CareerLevel::dropdownarray(),
            'categories'    => Category::dropdownarray(),
            'user'          => $user,
            'payment'       => $payment,
            'listingsLeft'  => $listingsLeft,
            'billing'       => $billing
        ];
        View::share($share_array);

        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->beforeFilter('jobAuthor', ['only' => ['edit', 'update', 'repost']]);

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        return Redirect::action('SearchController@index');
    }

    /**
     * Return setup view
     * @return \Illuminate\View\View
     */
    public function setup()
    {
        return View::make('jobs.setup');
    }

    /**
     * Store what job instances need to be created
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSetup()
    {
        Session::forget('pending_job.setup');
        switch (Input::get('setup'))
        {
            case 1:
                Session::put('pending_job.setup', Input::get('setup'));
                return Redirect::action('JobsController@create');
            break;
            case 2:
                Session::put('pending_job.setup', Input::get('setup'));
                return Redirect::action('JobsController@readerCreate');
            break;
            case 3:
                Session::put('pending_job.setup', Input::get('setup'));
                return Redirect::action('JobsController@create');
            break;
        }
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /jobs/create
	 *
	 * @return Response
	 */
	public function create()
	{
        // if there is a listing pending or edit from cart, pipe into the view
        if(Input::has('id') && Session::has('cart'))
        {
            $job = $this->jobRepo->getJobFromCart(Input::get('id'));
            Session::put('pending_job.epj_job', $job);

            // keeps clearing cart
            $this->jobRepo->removeFromCart(Input::get('id'));
        }

        if(Session::has('pending_job.epj_job'))
        {
            return View::make('jobs.create', ['job' => Session::get('pending_job.epj_job') ]);
        }

		return View::make('jobs.create');
	}

    /**
     * @return \Illuminate\View\View
     */
    public function readerCreate()
    {
        if(Session::has('pending_job.epj_job'))
        {
            $pendingJob = Session::has('pending_job.epj_job');
            return View::make('jobs.create_reader', ['pending_job' => $pendingJob]);
        }

        $readerPubDates = ReaderDate::dropdownarray();

        return View::make('jobs.create_reader', ['readerPubDates' => $readerPubDates]);
    }

    /**
     * Repost Trashed Job
     * @param $job_id
     * @return \Illuminate\View\View
     */
    public function repost($job_id)
    {
        // if user subscribe get remaining listings
        $listingsLeft = $this->userRepo->remainingSubscribedJobs();

        Session::put('pending_job', $this->jobRepo->getTrashedJobById($job_id));
        return View::make('jobs.create', [
            'job' => Session::get('pending_job'),
        ]);
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
        $pending_job = Session::get('pending_job.epj_job');
        $cost = $this->jobRepo->getCostFromExpireDate($pending_job->expire);
        $length = $this->jobRepo->getLengthFromExpireDate($pending_job->expire)." Day Job Listing";

        return View::make('jobs.review', ['pending_job' => $pending_job, 'cost' => $cost, 'length' => $length]);
    }

    /**
     * Display cart
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        // put pending job in cart
        if(Session::has('pending_job'))
        {
            $pending_job = Session::pull('pending_job');
            $this->jobRepo->putJobInCart($pending_job);
        }

        // if user subscribe get remaining listings
        $listingsLeft = $this->userRepo->remainingSubscribedJobs();

        // mark jobs in cart as subscribed if available
        $this->jobRepo->markSubscribedJobs($listingsLeft);

        // calculate total cost
        $cost = $this->jobRepo->calculateCost(Session::get('cart'), $listingsLeft);

        return View::make('jobs.cart', ['cart' => Session::get('cart'), 'cost' => $cost, 'listingsLeft' => $listingsLeft]);
    }

    /**
     * Delete job from cart
     * @return \Illuminate\View\View
     */
    public function deleteCart()
    {
        $jobId = Input::get('id');
        $this->jobRepo->removeFromCart($jobId);

        // if cart empty return to create route
        if(! count(Session::get('cart')))
        {
            return Redirect::action('JobsController@create');
        }

        return Redirect::action('JobsController@cart', ['cart' => Session::get('cart')])->with('success', 'Listing removed from cart.');
    }

    /**
     * Process the payment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment()
    {
        $newJobCommand = new PostNewJobCommand(Session::get('cart'));
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

        if(empty($job) || !$job->active)
        {
            return View::make('jobs.not_found');
        }

        $categories = $this->categoryRepo->getAllCategories();
        $similar_jobs = $this->jobRepo->searchMoreLikeThis($job);
        $recruiter_jobs = $this->jobRepo->moreByCompany($job);


        return View::make('jobs.show', [
            'job' => $job,
            'categories' => $categories,
            'similar_jobs' => $similar_jobs,
            'recruiter_jobs' => $recruiter_jobs
        ]);
	}

    /**
     * Display trashed job
     * @param $id
     * @return \Illuminate\View\View
     */
    public function showTrashed($id)
	{
        $job = $this->jobRepo->getTrashedJobById($id);

        if(empty($job))
        {
            return View::make('jobs.not_found');
        }

        $categories = $this->categoryRepo->getAllCategories();

        return View::make('jobs.show', [
            'job' => $job,
            'categories' => $categories,
        ]);
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
