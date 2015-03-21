<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/27/15
 * Time: 8:25 PM
 */

namespace EriePaJobs\Notifications;

use EriePaJobs\BaseCommand;
use EriePaJobs\Mailers\CreateContactMailer;

class CreateContactCommand extends BaseCommand {

    protected $input;

    function __construct($input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        if(!isset($this->input['phone']))
        {
            $this->input['phone'] = 'None given';
        }

        $adminEmailAddress = \Config::get('mail.administrator.email');
        $subject = 'EriePaJobs Website Contact From '. $this->input['name'];
        $user_name = 'EriePaJobs';

        \Mail::queue('emails.notifications.CreateContact', [
            'name' => $this->input['name'],
            'body' => $this->input['message'],
            'email' => $this->input['email'],
            'phone' => $this->input['phone']
        ], function($message) use ($adminEmailAddress, $user_name, $subject)
        {
            $message->to($adminEmailAddress, $user_name)->subject($subject);
        });

        $result['status'] = true;
        $result['message'] = 'Thank you for contacting us! Someone will be back to you shortly.';
        return $result;
    }
}