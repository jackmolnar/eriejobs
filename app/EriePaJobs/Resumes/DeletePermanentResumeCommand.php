<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 2/22/15
 * Time: 2:20 PM
 */

namespace EriePaJobs\Resumes;

use EriePaJobs\Users\UserRepository;
use EriePaJobs\BaseCommand;
use File;

class DeletePermanentResumeCommand extends BaseCommand{

    protected $user;

    function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the command
     */
    public function execute()
    {
        File::delete($this->user->resume->path);

        $this->user->resume->delete();
    }
}