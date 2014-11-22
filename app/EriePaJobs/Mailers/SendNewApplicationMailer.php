<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/2/14
 * Time: 2:36 PM
 */

namespace EriePaJobs\Mailers;

use EriePaJobs\BaseMailer;

class SendNewApplicationMailer extends BaseMailer
{
    /**
     * Send Application
     *
     * @param string $email_address
     * @param object $job
     * @param string $attachment_path
     */
    public function sendApplication($email_address, $job, $attachment_path = '')
    {
        \Mail::send('emails.applications.SendNewApplication', ['job' => $job], function($message) use ($email_address, $attachment_path, $job)
        {
            $message->to($email_address)->subject('New Application for '.$job->title.'from EriePa.Jobs');
            if($attachment_path != ''){
                $message->attach($attachment_path);
            }
        });
    }
}
