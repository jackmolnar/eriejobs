<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/11/15
 * Time: 1:39 PM
 */

namespace EriePaJobs\JobSeekers;


use EriePaJobs\BaseCommand;
use EriePaJobs\Notifications\NotificationRepository;

class UpdateSeekerNotificationsCommand extends BaseCommand{

    protected $input;

    function __construct(Array $input)
    {
        $this->input = $input;
        $this->notificationRepo = new NotificationRepository;
    }

    /**
     * Execute the command
     */
    public function execute()
    {
        foreach($this->input as $notificationId => $value)
        {
            $notification = $this->notificationRepo->notificationById($notificationId);
            if($notification)
            {
                $notification->delete();
            }
        }
    }
} 