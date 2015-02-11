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
     * @var NewJobPostedMailer
     */
    private $mailer;

    /**
     * @param NewJobPostedMailer $mailer
     */
    function __construct(NewJobPostedMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Model $job
     * @param \User $user
     */
    public function handle(Model $job, \User $user)
    {
        $this->mailer->sendTo($user, 'Job Listing Confirmation', 'emails.jobs.NewJobPosted', ['job' => $job]);
    }
}