<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 2/4/15
 * Time: 10:53 PM
 */

namespace EriePaJobs\Users;
use EriePaJobs\Notifications\NotificationRepository;
use Session;

class UserObserver {

    public function created ($model)
    {
        if($model->role->title == 'Seeker')
        {
            Session::flash('new_seeker_account', true);
        }

        if($model->role->title == 'Recruiter')
        {
            Session::flash('new_recruiter_account', true);
        }
    }

    public function deleting($model)
    {
        $notificationRepo = new NotificationRepository;

        $notificationRepo->deleteUserNotifications($model->id);
    }
}