<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/18/14
 * Time: 10:56 PM
 */

namespace EriePaJobs\Events\Auth;

class NewSeekerSubscribedHandler {

    protected $mailer;

    function __construct()
    {
    }

    /**
     * @param \User $user
     */
    public function handle(\User $user)
    {
        $subject = 'Welcome to EriePA Jobs';
        $user_email = $user->email;
        $user_first_name = $user->first_name;
        $user_last_name = $user->last_name;
        $user_name = $user_first_name.' '.$user_last_name;

        \Mail::queue('emails.auth.welcome_seeker', ['first_name' => $user_first_name], function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });
    }

} 