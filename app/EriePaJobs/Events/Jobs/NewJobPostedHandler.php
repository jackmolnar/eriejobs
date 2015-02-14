<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/28/14
 * Time: 10:26 PM
 */

namespace EriePaJobs\Events\Jobs;
use EriePaJobs\Mailers\NewJobPostedMailer;
use Illuminate\Database\Eloquent\Model;

class NewJobPostedHandler {


    /**
     * @param Model $job
     * @param \User $user
     */
    public function handle(Model $job, \User $user)
    {
//        $mailer = new NewJobPostedMailer;
        $job_title = $job->title;
//        $mailer->sendTo($user, 'Job Listing Confirmation', 'emails.jobs.NewJobPosted');

        $subject = 'Job Listing Confirmation';
        $user_email = $user->email;
        $user_name = $user->first_name.' '.$user->last_name;

        \Mail::queue('emails.jobs.NewJobPosted', ['job_title' => $job_title], function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });


    }
}