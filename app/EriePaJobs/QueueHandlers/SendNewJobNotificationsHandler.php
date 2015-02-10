<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/8/15
 * Time: 10:18 PM
 */

namespace EriePaJobs\QueueHandlers;


use EriePaJobs\Mailers\NewJobsNotificationMailer;
use EriePaJobs\Users\UserRepository;

class SendNewJobNotificationsHandler {


    /**
     * @var NewJobsNotificationMailer
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @param NewJobsNotificationMailer $mailer
     * @param UserRepository $userRepo
     */
    function __construct(NewJobsNotificationMailer $mailer, UserRepository $userRepo)
    {
        $this->mailer = $mailer;
        $this->userRepo = $userRepo;
    }

    /**
     * @param $job
     * @param $data
     */
    public function fire($job, $data)
    {
        $user = $this->userRepo->userById($data['user']['id']);

        $this->mailer->sendTo(
            $user,
            'New Job Listings',
            'emails.notifications.NewJobsPosted',
            ['jobData' => $data['results']]
        );

        $job->delete();
    }
} 