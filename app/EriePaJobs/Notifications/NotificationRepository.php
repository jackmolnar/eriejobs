<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/11/15
 * Time: 2:27 PM
 */

namespace EriePaJobs\Notifications;

use EriePaJobs\Users\UserRepository;
use VerificationCodes;
use Notification;

class NotificationRepository {

    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @internal param UserRepository $userRepo
     */
    function __construct()
    {
        $this->userRepo = new UserRepository;
    }

    /**
     * Get a notification by it's id
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function notificationById($id)
    {
        $notification = Notification::find($id);
        return $notification;
    }

    /**
     * Delete all notifications that belong to a user
     * @param $user_id
     * @throws \Exception
     */
    public function deleteUserNotifications($user_id)
    {
        $affectedRows = Notification::where('user_id', '=', $user_id)->delete();
    }

    /**
     * Get a current verification record by user id
     * @param $user_id
     * @return bool|\Illuminate\Database\Eloquent\Model|null|static
     */
    public function smsVerificationCodeByUserId($user_id)
    {
        $result = VerificationCodes::where('user_id', '=', $user_id)->first();

        if($result != null)
        {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Send the verify code to model phone number
     * @param integer $user_id
     * @param integer $phone_number
     * @param bool $verify_record
     * @return mixed
     */
    public function smsSendVerifyCode($user_id, $phone_number, $verify_record = false)
    {
        // generate random 6 digit number
        $verification_code = mt_rand(100000, 999999);

        // if no verify record currently exists, create new one
        // else update the old record
        if(!$verify_record)
        {
            $verify_record = VerificationCodes::create([
                'user_id' => $user_id,
                'verification_code' => $verification_code,
                'phone_number' => $phone_number
            ]);
        } else {
            $verify_record->verification_code = $verification_code;
            $verify_record->phone_number = $phone_number;
            $verify_record->save();
        }
        return $verify_record;
    }

    /**
     * Check if entered 6 digit number matches the verify record
     * @param $user_id
     * @param $verification_code
     * @return bool
     */
    public function smsVerificationCheck($user_id, $verification_code)
    {
        $verify_record = $this->smsVerificationCodeByUserId($user_id);

        if( $verify_record->verification_code != $verification_code || $verify_record == null)
        {
            return false;
        }
        return true;
    }

    /**
     * Delete verify record
     * @param integer $user_id
     */
    public function smsDeleteVerifyRecord($user_id)
    {
        $verify_record = $this->smsVerificationCodeByUserId($user_id);
        $verify_record->delete();
    }

    /**
     * Save verified phone number in user model
     * @param $user_id
     */
    public function smsSaveVerifiedPhoneNumber($user_id)
    {
        $verify_record = $this->smsVerificationCodeByUserId($user_id);
        $user = $this->userRepo->userById($user_id);
        $user->phone_number = $verify_record->phone_number;
        $user->save();
    }

    /**
     * Delete verified phone number in user model
     * @param $user_id
     */
    public function smsDeleteVerifiedPhoneNumber($user_id)
    {
        $user = $this->userRepo->userById($user_id);
        $user->phone_number = '';
        $user->sms_notifications = 0;
        $user->save();
    }

}