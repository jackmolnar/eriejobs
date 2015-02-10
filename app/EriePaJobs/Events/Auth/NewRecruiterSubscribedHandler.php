<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/18/14
 * Time: 10:56 PM
 */

namespace EriePaJobs\Events\Auth;

use EriePaJobs\Mailers\NewRecruiterSubscribedWelcomeMailer;

class NewRecruiterSubscribedHandler {

    protected $mailer;

    /**
     * @param NewRecruiterSubscribedWelcomeMailer $mailer
     */
    function __construct(NewRecruiterSubscribedWelcomeMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param \User $user
     */
    public function handle(\User $user)
    {
        $this->mailer->sendTo($user, 'Welcome to EriePA Jobs', 'emails.auth.welcome_recruiter', ['user' => $user]);
    }

} 