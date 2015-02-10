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
        $contactMailer = new CreateContactMailer;

        if(!isset($this->input['phone']))
        {
            $this->input['phone'] = 'None given';
        }

        $adminUser = \User::create([
            'email' => \Config::get('mail.administrator.email')
        ]);
        $contactMailer->sendTo($adminUser, 'Contact from '.$this->input['name'], 'emails.notifications.CreateContact', [
            'name' => $this->input['name'],
            'body' => $this->input['message'],
            'email' => $this->input['email'],
            'phone' => $this->input['phone']
        ]);

        $result['status'] = true;
        $result['message'] = 'Thank you for contacting us! Someone will be back to you shortly.';
        return $result;
    }
}