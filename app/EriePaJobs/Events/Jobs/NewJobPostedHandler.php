<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/28/14
 * Time: 10:26 PM
 */

namespace EriePaJobs\Events\Jobs;
use Illuminate\Database\Eloquent\Model;

class NewJobPostedHandler {


    /**
     * @param Model $job
     * @param \User $user
     */
    public function handle(Model $job, \User $user)
    {
        $job_title = $job->title;
        $subject = 'Job Listing Confirmation';
        $user_email = $user->email;
        $user_name = $user->first_name.' '.$user->last_name;

        // send confirmation email
        \Mail::queue('emails.Jobs.NewJobPosted', ['job_title' => $job_title], function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });

        // send sms notifications
        \Queue::push('EriePaJobs\QueueHandlers\SendNewSMSJobNotifications', ['job_id' => $job->id]);
    }
}