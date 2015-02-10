<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 12/29/14
 * Time: 10:38 PM
 */

namespace EriePaJobs\Notifications;
use EriePaJobs\BaseCommand;
use Auth;
use Notification;
use Category;

class CreateNotificationCommand extends BaseCommand{

    protected $user;
    protected $input;

    /**
     * @param $input
     */
    public function __construct($input)
    {
        $this->input = $input;
        $this->user = Auth::user();
    }

    /**
     * Execute the command
     * @return bool
     */
    public function execute()
    {
        // check if search term exists
        if(Notification::where('term', '=', $this->input)->first())
        {
            return false;
        }

        // set the notifications
        $notification = new Notification;
        $notification->user_id = $this->user->id;
        $notification->term = $this->input;
        $notification->save();

        return true;
    }

} 