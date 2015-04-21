<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 4/20/15
 * Time: 8:11 PM
 */

namespace EriePaJobs\QueueHandlers;

use EriePaJobs\Jobs\JobsRepository;

class SendJobNotificationEmail {


    /**
     * @param JobsRepository $jobRepo
     */
    function __construct(JobsRepository $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    public function fire($job, $data)
    {
        foreach($data['jobIds'] as $id)
        {
            $resultsArray[] = $this->jobRepo->getJobById($id);
        }

        $subject = $data['emailInfo']['subject'];
        $user_email = $data['emailInfo']['user_email'];
        $user_name = $data['emailInfo']['user_name'];

        \Mail::send('emails.notifications.NewJobsPosted', ['first_name' => $data['emailInfo']['user_name'], 'jobData' => $resultsArray], function($message) use ($user_email, $user_name, $subject)
        {
            $message->to($user_email, $user_name)->subject($subject);
        });
    }


}