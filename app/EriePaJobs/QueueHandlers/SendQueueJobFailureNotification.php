<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/10/15
 * Time: 11:35 AM
 */

namespace EriePaJobs\QueueHandlers;


use EriePaJobs\Mailers\QueueJobFailedMailer;

class SendQueueJobFailureNotification {


    public function fire($job, $data)
    {
//        dd($job->getPheanstalkJob()->getData());
        $mailer = new QueueJobFailedMailer;
        $mailer->sendNotification(\Config::get('mail.administrator'), 'Queue Job Failed', 'emails.notifications.QueueFailureNotification', $data);

        $job->delete();
    }

} 