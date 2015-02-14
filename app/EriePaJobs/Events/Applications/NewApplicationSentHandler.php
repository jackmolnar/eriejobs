<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/6/14
 * Time: 8:00 PM
 */

namespace EriePaJobs\Events\Applications;

use Illuminate\Database\Eloquent\Model;

class NewApplicationSentHandler
{

    function __construct()
    {
    }

    /**
     * @param \User $user
     * @param Model $job
     */
    public function handle(\User $user, Model $job)
    {
        $subject = 'Your Application Has Been Sent!';
        $user_email = $user->email;
        $user_first_name = $user->first_name;
        $user_last_name = $user->last_name;
        $user_name = $user_first_name.' '.$user_last_name;
        $job_title = $job->title;

        \Mail::queue('emails.applications.ApplicationSentConfirmation', ['first_name' => $user_first_name, 'job_title' => $job_title], function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });
    }
} 