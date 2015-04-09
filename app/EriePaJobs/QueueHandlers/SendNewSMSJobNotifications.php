<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 3/17/15
 * Time: 11:03 PM
 */

namespace EriePaJobs\QueueHandlers;

use EriePaJobs\Jobs\JobsRepository;

class SendNewSMSJobNotifications {


    function __construct()
    {
        $this->jobRepo = new JobsRepository;
    }

    public function fire($job, $data)
    {
        $newJob = $this->jobRepo->getJobById($data['job_id']);

        $smsUsers = \User::smsNotifications()->with('jobNotifications')->get();

        // loop through each user
        foreach($smsUsers as $user)
        {
            // loop through users notification terms
            foreach($user->jobNotifications as $term)
            {

                // search jobs based on term
                $searchResults = $this->jobRepo->searchForJob($term->term);

                // loop through search results
                foreach($searchResults as $result)
                {
                    if($result->id == $newJob->id)
                    {
                        $url = url('jobs').'/'.$newJob->id;
                        \Twilio::message('+'.$user->phone_number, 'EriePaJobs - A new job was just posted that matches your settings. View it and apply here - '.$url);
                    }
                }
            }
        }

        $job->delete();
    }

}