<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 4/28/15
 * Time: 10:02 PM
 */

namespace EriePaJobs\QueueHandlers;

use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Users\UserRepository;

class SendJobExpiringSoonEmail {

    protected $jobsRepo;
    /**
     * @var UserRepository
     */
    private $userRepo;

    function __construct(JobsRepository $jobsRepo, UserRepository $userRepo)
    {
        $this->jobsRepo = $jobsRepo;
        $this->userRepo = $userRepo;
    }

    public function fire($job, $data)
    {
        $expiringJob = $this->jobsRepo->getJobById($data['jobid']);

        $author = $this->userRepo->userById($expiringJob->user_id);

        $subject = 'You Job Listing For '.$expiringJob->title.' is Expiring Soon';
        $user_email = $author->email;
        $user_name = $author->first_name.' '.$author->last_name;

        \Mail::send('emails.notifications.JobExpiringSoon', ['first_name' => $user_name, 'expiringJob' => $expiringJob], function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });

        $job->delete();

    }
}