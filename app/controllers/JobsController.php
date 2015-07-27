<?php

use EriePaJobs\Categories\CategoryRepository;
use EriePaJobs\Jobs\DeleteJobCommand;
use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Jobs\PostNewReaderJobCommand;
use EriePaJobs\Jobs\PostNewReaderJobValidator;
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
            $package = $this->jobRepo->getPackageFromCart(Input::get('id'));

            $this->jobRepo->storeEpjJob($package['epj']);
            $this->jobRepo->storeReaderJob($package['reader']);

            // keeps clearing cart
            $this->jobRepo->removePackageFromCart(Input::get('id'));
        }

        if(Session::has('pending_epj'))
        {
            return View::make('jobs.create', ['job' => $this->jobRepo->getPendingEpjJob() ]);
        }

		return View::make('jobs.create');
	}

    /**
     * @return \Illuminate\View\View
     */
    public function readerCreate()
    {
        $readerPubDates = ReaderDate::dropdownarray();

        $readerHeadings = Reader_Heading::dropdownarray();

        if(Session::has('pending_reader'))
        {
            $pendingJob = $this->jobRepo->getPendingReaderJob();
        } else {
            $pendingJob = $this->jobRepo->getPendingEpjJob();
        }

        return View::make('jobs.create_reader', [
            'pendingJob' => $pendingJob,
            'readerPubDates' => $readerPubDates,
            'readerHeadings' => $readerHeadings
        ]);
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
     * Store the reader ad in the session
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function readerStore()
    {
        $newReaderJobValidator = new PostNewReaderJobValidator(Input::all());
        $valid = $newReaderJobValidator->execute();

        if($valid['status'])
        {
            $newReaderJobCommand = new PostNewReaderJobCommand(Input::all());
            $newReaderJobCommand->execute();
            return Redirect::action('JobsController@readerReview');
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
        $pending_job = $this->jobRepo->getPendingEpjJob();
        $cost = $this->jobRepo->getCostFromExpireDate($pending_job->expire);
        $length = $this->jobRepo->getLengthFromExpireDate($pending_job->expire)." Day Job Listing";

        return View::make('jobs.review', ['pending_job' => $pending_job, 'cost' => $cost, 'length' => $length]);
    }

    /**
     * Review reader job listing
     *
     * @return \Illuminate\View\View
     */
    public function readerReview()
    {
        $pending_reader_job = $this->jobRepo->getPendingReaderJob();
        $pubDate = $pending_reader_job->pubDate->pub_date->toFormattedDateString();

        return View::make('jobs.review_reader', ['pending_reader_job' => $pending_reader_job, 'pubDate' => $pubDate]);
    }

    /**
     * Display cart
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        // package pending jobs with cost, put in cart
        if(Session::has('pending_epj') && Session::has('pending_reader'))
        {
            $package = [
                'cost' => $this->jobRepo->getCostFromDescriptionLength(Session::get('pending_reader')->description),
                'epj' => Session::pull('pending_epj'),
                'reader' => Session::pull('pending_reader'),
            ];

            $this->jobRepo->putJobInCart($package);
        }

        try {
            $cost = $this->jobRepo->calculateCost(Session::get('cart'));
        } catch (Exception $e) {
            return Redirect::action('ProfilesController@index')->withErrors($e->getMessage());
        }
        // calculate total cost

        return View::make('jobs.cart', ['cart' => Session::get('cart'), 'cost' => $cost]);
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
            return Redirect::back()->withErrors($result['message']);
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
