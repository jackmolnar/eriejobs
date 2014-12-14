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
use EriePaJobs\Payments\PaymentRepository;
use Event;
use Session;
use Job;

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
        $this->paymentRepo = new PaymentRepository;
    }

    /**
     * Execute the Command method based on the flag
     */
    public function execute($flag = '')
    {
        if($flag != '')
        {
            return $result = $this->$flag();
        }
    }

    /**
     * Create the job in the Session
     * @return Job
     */
    public function create()
    {
        $job = new Job;
        $job->title             = $this->input['title'];
        $job->description       = $this->input['description'];
        $job->company_name      = $this->input['company_name'];
        $job->company_address   = $this->input['company_address'];
        $job->company_city      = $this->input['company_city'];
        $job->state_id          = $this->input['company_state'];
        $job->salary            = isset($this->input['salary']) ? $this->input['salary'] : 'Not Set';
        $job->career_level      = $this->input['career_level'];
        $job->type_id           = $this->input['type'];
        $job->user_id           = $this->user->id;
        $job->email             = isset($this->input['email']) ? $this->input['email'] : '';
        $job->link              = isset($this->input['link']) ? $this->input['link'] : '';
        $job->expire            = $this->jobsRepo->createExpireDate($this->input['length']);
        $job->confidential      = isset($this->input['confidential']) ? $this->input['confidential'] : false;
        $job->category_id       = $this->input['category'];

        Session::put('pending_job', $job);

        return $job;
    }

    /**
     * Attempt to bill the user and save / post the job
     */
    public function bill()
    {
        $result = $this->paymentRepo->bill($this->input);

        if($result['status'])
        {
            $job = Session::pull('pending_job');

            $job->save();

            $job->categories()->sync([$job->category_id]);

            Event::fire('job.create', array($job, $this->user));

        }

        return $result;
    }
}