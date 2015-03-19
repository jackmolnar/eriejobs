<?php

use EriePaJobs\Notifications\CreateNotificationCommand;
use EriePaJobs\Notifications\NotificationRepository;

class NotificationsController extends \BaseController {

	/**
	 * @var NotificationRepository
	 */
	private $notifyRepo;

	function __construct(NotificationRepository $notifyRepo)
	{
		$this->notifyRepo = $notifyRepo;
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /notifications/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$searchTerm = Input::get('searchTerm');

        $createNotification = new CreateNotificationCommand($searchTerm);

        $result = $createNotification->execute();

        $result = $result ? "You're Signed Up!" : "You're Already Signed Up for This Term!";

        return $result;
	}

	/**
	 * Handle sending the sms verification code ajax route
	 * POST /send-verification-code
     */
	public function send_sms_verification_code()
	{
		$user_id = Input::get('userId');
		$phone_number = Input::get('phoneNumber');

		// check if a verify record already exists
		$verify_record = $this->notifyRepo->smsVerificationCodeByUserId($user_id);

		// create the code, save it, send to user
		$verify_record = $this->notifyRepo->smsSendVerifyCode($user_id, $phone_number, $verify_record);

		$result = Twilio::message('+'.$phone_number, 'EriePaJobs - Your verification code is '.$verify_record->verification_code);
	}

	/**
	 * Handle verifying that the 6 digit code matches the creating user
	 * @return mixed
	 * POST /verify-phone-number
     */
	public function verify_phone_number()
	{
		$user_id = Input::get('userId');
		$verification_code = Input::get('verificationCode');

		if ($this->notifyRepo->smsVerificationCheck($user_id, $verification_code))
		{
			$this->notifyRepo->smsSaveVerifiedPhoneNumber($user_id);
			$this->notifyRepo->smsDeleteVerifyRecord($user_id);
			$valid = [
				'status' => true,
				'message' => 'Your phone number has been verified.'
			];
			return $valid;
		}

		$valid = [
			'status' => false,
			'message' => 'The code you entered does not match the code we sent you.'
		];
		return $valid;
	}

	/**
	 * Handle deleting a verified phone number
	 * @param $user_id
	 * @return \Illuminate\Http\RedirectResponse
	 * GET /delete-phone-number/{id}
     */
	public function delete_phone_number($user_id)
	{
		$this->notifyRepo->smsDeleteVerifiedPhoneNumber($user_id);
		return Redirect::action('ProfilesController@edit_notification_settings')->with('success', 'Your phone number has been deleted');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /notifications
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /notifications/{id}
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
	 * GET /notifications/{id}/edit
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
	 * PUT /notifications/{id}
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
	 * DELETE /notifications/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}