<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/26/14
 * Time: 1:11 PM
 */

namespace EriePaJobs\Jobs;

use EriePaJobs\BaseCommand;
use Auth;
use Event;

class DeleteJobCommand extends BaseCommand{

    /**
     * @var
     */
    protected $input;
    /**
     * @var
     */
    protected $id;
    /**
     * @var JobsRepository
     */
    private $jobsRepo;


    /**
     * Set up command
     *
     * @param integer $id
     * @internal param JobsRepository $jobsRepo
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->user = Auth::user();
        $this->jobsRepo = new JobsRepository;
    }

    /**
     * Execute the Command and Fire the job.delete event
     */
    public function execute()
    {
        $job = $this->jobsRepo->getJobById($this->id);
        if($job->user_id != $this->user->id && $this->user->role->title != 'Administrator')
        {
            $result['status'] = false;
            $result['message'] = "You are not authorized to delete this listing";
            return $result;
        }
        $result['status'] = $this->jobsRepo->deleteJob($this->id);
        $result['message'] = "Your job listing has been deleted.";

        Event::fire('job.delete', array($job, $this->user));

        return $result;
    }
} 