<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/18/14
 * Time: 10:56 PM
 */

namespace EriePaJobs\Events\Auth;


use EriePaJobs\Mailers\NewSeekerSubscribedWelcomeMailer;

class NewSeekerSubscribedHandler {

    protected $mailer;

    /**
     * @param NewSeekerSubscribedWelcomeMailer $mailer
     */
    function __construct(NewSeekerSubscribedWelcomeMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param \User $user
     */
    public function handle(\User $user)
    {
        $this->mailer->sendTo($user, 'Welcome to EriePA Jobs', 'emails.auth.welcome', ['user' => $user]);
    }

} 