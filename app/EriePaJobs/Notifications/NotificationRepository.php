<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 1/11/15
 * Time: 2:27 PM
 */

namespace EriePaJobs\Notifications;

use Notification;

class NotificationRepository {

    /**
     * Get a notification by it's id
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    public function notificationById($id)
    {
        $notification = Notification::find($id);
        return $notification;
    }

    /**
     * Delete all notifications that belong to a user
     * @param $user_id
     * @throws \Exception
     */
    public function deleteUserNotifications($user_id)
    {

        $affectedRows = Notification::where('user_id', '=', $user_id)->delete();

//        dd(count(Notification::where('user_id', '=', $user_id)->get()));
    }

}