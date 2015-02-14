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
        $mailer = new NewJobPostedMailer;
        $job_title = $job->title;
        $mailer->sendTo($user, 'Job Listing Confirmation', 'emails.jobs.NewJobPosted', ['job_title' => $job_title]);
    }
}