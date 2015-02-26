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
     * @return \Illuminate\Support\Collection|static
     */
    public function userById($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Get the authed user
     * @return null|User
     */
    public function authedUser()
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * Get resume record by user id
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getResumeByUserId($user_id)
    {
        $resume = \Resume::where('user_id', '=', $user_id)->first();
        return $resume;
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
} 