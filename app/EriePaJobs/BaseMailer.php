<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/28/14
 * Time: 10:42 PM
 */

namespace EriePaJobs;
use Mail;

abstract class BaseMailer {

    public function sendTo(\User $user, $subject, $view, $data = [], $attachment_path = '')
    {
        Mail::queue($view, $data, function($message) use ($user, $subject, $attachment_path)
        {
            $message->to($user->email, $user->first_name.' '.$user->last_name)->subject($subject);

            if($attachment_path != ''){
                $message->attach($attachment_path);
            }
        });
    }

} 