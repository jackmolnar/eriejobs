<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/10/15
 * Time: 11:19 AM
 */

namespace EriePaJobs\Mailers;


use EriePaJobs\BaseMailer;

class QueueJobFailedMailer extends BaseMailer{

    function __construct()
    {
    }

    /**
     * @param $email
     * @param $subject
     * @param $view
     * @param array $data
     */
    public function sendNotification($email, $subject, $view, $data = [])
    {
        \Mail::send($view, $data, function($message) use ($subject, $email)
        {
            $message->to($email, 'Administrator')->subject($subject);
        });
    }

}