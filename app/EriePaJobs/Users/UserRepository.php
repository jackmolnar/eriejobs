<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/28/14
 * Time: 2:37 PM
 */

namespace EriePaJobs\Users;

use User;
use Auth;

class UserRepository {

    /**
     * Get user by their id
     * @param $id Integer
     * @param bool $trashed
     * @return \Illuminate\Support\Collection|static
     */
    public function userById($id, $trashed = false)
    {
        if($trashed == true) return $user = User::withTrashed()->whereId($id)->first();
        return $user = User::find($id);
    }

    /**
     * Get user by email address
     * @param $email
     * @param bool $trashed
     * @return mixed
     */
    public function userByEmail($email, $trashed = false)
    {
        if($trashed == true) return $user = User::withTrashed()->whereEmail($email)->first();
        return $user = User::whereEmail($email)->first();
    }

    /**
     * Get the authed user
     * @return null|User
     */
    public function authedUser()
    {
        return $user = Auth::user();
    }

    /**
     * Check if user signed up for notification
     * @param $user
     * @param $term
     * @return bool
     */
    public function checkNotification($user, $term)
    {
        foreach($user->jobNotifications as $notification)
        {
            if($term == $notification->term) return $notification;
        }
        return false;
    }

    /**
     * Get resume record by user id
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getResumeByUserId($user_id)
    {
        return $resume = \Resume::where('user_id', '=', $user_id)->first();
    }

    /**
     * Get a users resume filename
     * @param string $id
     * @return mixed
     */
    public function getResumeFileName($id = 'authed user')
    {
        if($id == 'authed user')
        {
            $id = $this->authedUser()->id;
        }

        $resume = $this->getResumeByUserId($id);
        $filename = basename($resume->path);

        return $filename;
    }

    /**
     * Get users subscribed jobs
     * @return mixed
     */
    public function subscribedJobs($user = null)
    {
        if($user == null)
        {
            $user = $this->authedUser();
        }

        if($user->subscribed() || $user->cancelled())
        {
            return $jobs = $user->jobs()->where('active', '=', 1)->where('subscription', '=', 1)->get();
        }

        return 0;
    }

    /**
     * Get number of listings user has left
     * @return mixed|null
     */
    public function remainingSubscribedJobs()
    {
        $user = $this->authedUser();
        if($user->subscribed())
        {
            $usedJobs = count($this->subscribedJobs());

            $plan = $user->getStripePlan();

            $plan = ucfirst(str_replace('plan', '', $plan));

            $allowedJobs = \Config::get('billing.subscriptions.'.$plan.'.listings');

            return $listingsLeft = $allowedJobs - $usedJobs;
        }
        return 0;
    }
} 