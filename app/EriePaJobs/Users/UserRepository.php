<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/28/14
 * Time: 2:37 PM
 */

namespace EriePaJobs\Users;

use User;

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
} 