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

    function __construct($user, $job)
    {
        $this->appRepo = new ApplicationsRepository;
        $this->user = $user;
        $this->job = $job;
    }

    public function execute()
    {
        $this->appRepo->createApplicationRecord($this->user->id, $this->job->id);
    }
}