<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 2/1/15
 * Time: 2:06 PM
 */

namespace EriePaJobs\Jobs;


class JobsObserver {


    protected $jobsRepo;

    function __construct()
    {
        $this->jobsRepo = new JobsRepository;
    }

    /**
     * Created model event
     * @param $job
     */
    public function created($job)
    {
        $job->index();
        $this->jobsRepo->updateAllJobsCache();
    }

    /**
     * Saved model event
     * @param $job
     */
    public function saved($job)
    {
        if($job->active == 0){
            $job->removeIndex();
        } elseif ($job->active == 1){
            $job->index();
        }
        $this->jobsRepo->updateAllJobsCache();
    }

    /**
     * Deleted model event
     * @param $job
     */
    public function deleted($job)
    {
        $job->removeIndex();
        $this->jobsRepo->updateAllJobsCache();
    }


}