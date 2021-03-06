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

class UpdateJobCommand extends BaseCommand{

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
     * @param $input
     * @param integer $id
     * @internal param JobsRepository $jobsRepo
     */
    public function __construct($input, $id)
    {
        $this->input = $input;
        $this->id = $id;
        $this->user = Auth::user();
        $this->jobsRepo = new JobsRepository;
    }

    /**
     * Execute the Command and Fire the job.create event
     */
    public function execute()
    {
        $job                    = $this->jobsRepo->getJobById($this->id);
        $job->title             = $this->input['title'];
        $job->description       = $this->input['description'];
        $job->company_name      = $this->input['company_name'];
        $job->company_address   = $this->input['company_address'];
        $job->company_city      = $this->input['company_city'];
        $job->state_id          = $this->input['company_state'];
        $job->salary            = isset($this->input['salary']) ? $this->input['salary'] : 'Not Set';
        $job->career_level_id   = $this->input['career_level'];
        $job->type_id           = $this->input['type'];
        $job->user_id           = $this->user->id;
        $job->email             = isset($this->input['email']) ? $this->input['email'] : '';
        $job->link              = isset($this->input['link']) ? $this->input['link'] : '';
        $job->confidential      = isset($this->input['confidential']) ? $this->input['confidential'] : false;

        $job->save();

        $job->categories()->sync(array($this->input['category']));

        Event::fire('job.update', array($job, $this->user));

        return $job;

    }
} 