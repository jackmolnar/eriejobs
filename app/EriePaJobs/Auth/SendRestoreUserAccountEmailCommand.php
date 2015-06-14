<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 6/13/15
 * Time: 1:02 PM
 */

namespace EriePaJobs\Auth;

use EriePaJobs\BaseCommand;
use EriePaJobs\Users\UserRepository;

class SendRestoreUserAccountEmailCommand extends BaseCommand{

    protected $email;

    /**
     * @param $email
     */
    function __construct($email)
    {
        $this->email = $email;
        $this->userRepo = new UserRepository;
    }

    public function execute()
    {
        // get the user
        $user = $this->userRepo->userByEmail($this->email, true);

        // if trashed user exists
        if($user != null)
        {
            $user_email = $user->email;
            $user_name = $user->first_name.' '.$user->last_name;
            $subject = 'Restore Your Account on EriePaJobs';

            // send restore email
            \Mail::queue('emails.auth.restore_user', ['user_id' => $user->id, 'user_name' => $user_name], function($message) use ($user_email, $user_name, $subject)
            {
                $message->to($user_email, $user_name)->subject($subject);
            });

            return true;
        }

        return false;
    }
}