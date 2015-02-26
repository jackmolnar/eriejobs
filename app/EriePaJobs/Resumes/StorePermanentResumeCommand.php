<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 2/21/15
 * Time: 5:05 PM
 */

namespace EriePaJobs\Resumes;

use EriePaJobs\Applications\ApplicationsRepository;
use EriePaJobs\BaseCommand;
use EriePaJobs\Users\UserRepository;
use File;

class StorePermanentResumeCommand extends BaseCommand{

    protected $input;

    function __construct($input)
    {
        $this->input = $input;
    }

    public function execute()
    {
        // get repos
        $applicationRepo = new ApplicationsRepository;
        $userRepo = new UserRepository;

        // get authed user
        $user = $userRepo->authedUser();

        // if user already has an uploaded resume, delete it
        if($user->resume != '')
        {
            $resumePath = $user->resume->path;
            File::delete($resumePath);
            $user->resume->delete();
        }

        //upload the resume
        $path = $applicationRepo->uploadPermanentResume($this->input);

        //save new resume record
        $applicationRepo->createResumeRecord($user->id, $path);
    }
}