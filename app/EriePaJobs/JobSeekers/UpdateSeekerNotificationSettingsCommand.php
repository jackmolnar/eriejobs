<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 3/17/15
 * Time: 9:49 PM
 */

namespace EriePaJobs\JobSeekers;

use EriePaJobs\BaseCommand;
use EriePaJobs\Users\UserRepository;

class UpdateSeekerNotificationSettingsCommand extends BaseCommand {

    /**
     * @var
     */
    private $input;

    function __construct($user_id, $input)
    {
        $this->userRepo = new UserRepository;
        $this->user = $this->userRepo->userById($user_id);
        $this->input = $input;
    }

    public function execute()
    {
        $this->user->email_notifications = isset($this->input['email_notifications']) ? $this->input['email_notifications'] : 0;
        $this->user->sms_notifications = isset($this->input['sms_notifications']) ? $this->input['sms_notifications'] : 0;

        $this->user->save();
    }
}