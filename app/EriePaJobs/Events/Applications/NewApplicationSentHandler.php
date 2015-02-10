<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/6/14
 * Time: 8:00 PM
 */

namespace EriePaJobs\Events\Applications;

use EriePaJobs\Mailers\SendNewApplicationConfirmationMailer;
use Illuminate\Database\Eloquent\Model;

class NewApplicationSentHandler
{

    /**
     * @var SendNewApplicationConfirmationMailer
     */
    private $mailer;

    function __construct(SendNewApplicationConfirmationMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param \User $user
     * @param Model $job
     */
    public function handle(\User $user, Model $job)
    {
        $this->mailer->sendTo($user, 'Your Application Has Been Sent!', 'emails.applications.ApplicationSentConfirmation', ['job' => $job, 'user' => $user]);
    }
} 