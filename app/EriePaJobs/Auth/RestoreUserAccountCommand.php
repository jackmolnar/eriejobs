<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 6/13/15
 * Time: 12:26 PM
 */

namespace EriePaJobs\Auth;

use EriePaJobs\BaseCommand;
use EriePaJobs\Users\UserRepository;

class RestoreUserAccountCommand extends BaseCommand{

    protected $user_id;

    /**
     * @param $user_id
     */
    function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->userRepo = new UserRepository;
    }

    public function execute()
    {
        // get the user
        $user = $this->userRepo->userById($this->user_id, true);

        // if trashed user exists
        if($user != null)
        {
            $user->restore();
            return true;
        }

        return false;
    }
}