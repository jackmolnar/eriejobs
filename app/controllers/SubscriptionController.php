<?php

use EriePaJobs\Subscriptions\CreateNewSubscriptionCommand;
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
		// create subscription
		$newSubscriptionCommand = new CreateNewSubscriptionCommand(Input::all());
		$result = $newSubscriptionCommand->execute();

		// if jobs in cart redirect
		if(Session::has('cart') && count(Session::get('cart'))) return Redirect::action('JobsController@cart')->with('success', $result['message']);

		return Redirect::action('ProfilesController@index')->with('success', $result['message']);
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
		if($this->userRepo->authedUser()->subscribed())
		{
			$this->userRepo->authedUser()->subscription()->cancel();
			$endDate = $this->userRepo->authedUser()->getSubscriptionEndDate()->format('m/d/Y');
			return Redirect::action('ProfilesController@index')->with('success', 'Your subscription has been canceled and ends on '.$endDate.'.');
		}

		return Redirect::action('ProfilesController@index')->with('errors', 'You were not subscribed.');
	}

	/**
	 * Build the button based on subscription selected
	 * @return string
     */
	public function button()
	{
		$data = Input::all();

		$result = '
			<script
					id="checkout_script"
					src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					data-key="'. getenv('STRIPE_PUBLISHABLE_KEY') .'"
					data-image=""
					data-name="EriePaJobs.com"
					data-description="'.$data['plan'].' Plan"
					data-amount="'.$data['cost'].'"
					data-email="'.$this->userRepo->authedUser()->email.'"
					data-label="Pay For Subscription"
					data-allow-remember-me="false"
						>
			</script>';

		return $result;
	}
}