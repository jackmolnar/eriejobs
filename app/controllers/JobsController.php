<?php

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

    function __construct(JobsRepository $jobRepo, PaymentRepository $paymentRepo)
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
    }

    /**
	 * Display a listing of the resource.
	 * GET /jobs
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
            return View::make('jobs.create', ['job' => Session::get('pending_job')]);
        }

		return View::make('jobs.create');

	}

	/**
	 * Store a newly created resource in storage.
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

        return View::make('jobs.confirm', ['pending_job' => $pending_job, 'cost' => $cost]);
    }

    public function payment()
    {



        // Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account
        Stripe::setApiKey("sk_test_sHX7ljvlFj1nozB8TIiisE7h");

// Get the credit card details submitted by the form
        $token = Input::get('stripeToken');

// Create the charge on Stripe's servers - this will charge the user's card
        try {
            $charge = Stripe_Charge::create(array(
                    "amount" => 1000, // amount in cents, again
                    "currency" => "usd",
                    "card" => $token,
                    "description" => "payinguser@example.com")
            );
            return $charge;
        } catch(Stripe_CardError $e) {
            // The card has been declined
            return $e;
        }

//        return View::make('jobs.payment');
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
        return View::make('jobs.show', ['job' => $job]);
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
        }

        $this->jobRepo->activateJob($id);
    }


}