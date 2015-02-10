<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 2/3/15
 * Time: 9:06 PM
 */

namespace EriePaJobs\Users;


use EriePaJobs\BaseCommand;
use EriePaJobs\Notifications\NotificationRepository;

class DeleteAccountCommand extends BaseCommand{

    /**
     * @var
     */
    protected $user_id;

    function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->userRepo = new UserRepository;
    }

    public function execute()
    {
        $user = $this->userRepo->userById($this->user_id);

        $user->delete();

        return true;
    }
}