<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 4/8/15
 * Time: 8:47 PM
 */

namespace EriePaJobs\Applications;

use EriePaJobs\BaseCommand;

class CreateApplicationCommand extends BaseCommand{

    /**
     * @var
     */
    private $user;
    /**
     * @var
     */
    private $job;
    /**
     * @var
     */
    private $appData;

    function __construct($user, $job, $appData)
    {
        $this->appRepo = new ApplicationsRepository;
        $this->user = $user;
        $this->job = $job;
        $this->appData = $appData;
    }

    public function execute()
    {
        // get the app resume path
        // get cover letter text
        $this->appRepo->createApplicationRecord($this->user->id, $this->job->id, $this->appData['resume_path'], $this->appData['cover_letter']);
    }
}