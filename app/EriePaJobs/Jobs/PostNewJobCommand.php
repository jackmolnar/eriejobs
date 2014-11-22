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

class PostNewJobCommand extends BaseCommand{

    /**
     * @var
     */
    protected $input;
    /**
     * @var JobsRepository
     */
    private $jobsRepo;

    /**
     * Set up command
     *
     * @param $input
     * @internal param JobsRepository $jobsRepo
     */
    public function __construct($input)
    {
        $this->input = $input;
        $this->user = Auth::user();
        $this->jobsRepo = new JobsRepository;
    }

    /**
     * Execute the Command and Fire the job.create event
     */
    public function execute()
    {
        $job = new \Job;
        $job->title = $this->input['title'];
        $job->description = $this->input['description'];
        $job->company_name = $this->input['company_name'];
        $job->company_address = $this->input['company_address'];
        $job->company_city = $this->input['company_city'];
        $job->state_id = $this->input['company_state'];
        $job->salary = $this->input['salary'];
        $job->career_level = $this->input['career_level'];
        $job->type_id = $this->input['type'];
        $job->user_id = $this->user->id;
        $job->email = $this->input['email'];
        $job->link = $this->input['link'];
        //$job->expire = $this->jobsRepo->createExpireDate($this->input['length']);

        $job->save();

        $job->categories()->sync(array($this->input['category']));

        Event::fire('job.create', array($job, $this->user));

    }
} 