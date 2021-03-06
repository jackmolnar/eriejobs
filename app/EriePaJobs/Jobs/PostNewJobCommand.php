<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 10/26/14
 * Time: 1:11 PM
 */

namespace EriePaJobs\Jobs;

use EriePaJobs\BaseCommand;
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
        // this->input is the cart
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

        $this->jobsRepo->storeEpjJob($job);

        return $job;
    }

    /**
     * Attempt to bill the user and save / post the job
     */
    public function bill()
    {
        $result['status'] = true;

        // if not free and not admin, bill
        if(!Config::get('billing.free') && $this->user->role->title != 'Administrator') {
            $result = $this->paymentRepo->bill($this->input);
        }

        // if billing successful, save jobs
        if($result['status'])
        {
            // get the cart or the pending job from session
            $cart = Session::has('cart') ? Session::pull('cart') : Session::pull('pending_job');

            // save each job in the cart
            foreach($cart as $package)
            {
                // set the category id and remove the attribute from the job object
                // so that the job object can be saved (category id is not a field)
                $category_id = $package['epj']->category_id;
                unset($package['epj']->category_id);

                //save the epj job
                $package['epj']->save();

                //save the reader job
                $package['reader']->save();

                //sync the categories
                $package['epj']->categories()->sync([$category_id]);

                //fire the job create event
                Event::fire('job.create', array($package, $this->user));
            }
        }

        return $result;
    }
}