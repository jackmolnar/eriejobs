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
use EriePaJobs\Users\UserRepository;
use Event;
use Session;
use Job;
use Config;

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
        $this->userRepo = new UserRepository;
        $this->user = $this->userRepo->authedUser();
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
        $job->salary            = $this->input['salary'] != '' ? $this->input['salary'] : 'Not Set';
        $job->career_level_id   = $this->input['career_level'];
        $job->type_id           = $this->input['type'];
        $job->user_id           = $this->user->id;
        $job->email             = isset($this->input['email']) ? $this->input['email'] : '';
        $job->link              = isset($this->input['link']) ? $this->input['link'] : '';
        $job->expire            = $this->jobsRepo->createExpireDate($this->input['length']);
        $job->confidential      = isset($this->input['confidential']) ? $this->input['confidential'] : false;
        $job->category_id       = $this->input['category'];
        $job->active            = 1;

        Session::put('pending_job', $job);

        return $job;
    }

    /**
     * Attempt to bill the user and save / post the job
     */
    public function bill()
    {
        if(!Config::get('billing.free')) {
            $result = $this->paymentRepo->bill($this->input);
        } else {
            $result['status'] = true;
        }

        if($result['status'])
        {
            // get the job from session
            $job = Session::pull('pending_job');

            // set the category id and remove the attribute from the job object
            // so that the job object can be saved (category id is not a field)
            $category_id = $job->category_id;
            unset($job->category_id);

            //save the job
            $job->save();

            //sync the categories
            $job->categories()->sync([$category_id]);

            //fire the create event
            Event::fire('job.create', array($job, $this->user));

        }

        return $result;
    }
}