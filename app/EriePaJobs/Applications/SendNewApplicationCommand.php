<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/1/14
 * Time: 8:15 PM
 */

namespace EriePaJobs\Applications;

use EriePaJobs\BaseCommand;
use EriePaJobs\Users\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SendNewApplicationCommand extends BaseCommand{

    protected $input;
    protected $resume;
    protected $job;
    protected $appRepo;

    /**
     * @param array|\Input $input
     * @param $resume
     * @param model | $job
     * @internal param ApplicationsRepository $appRepo
     * @internal param SendNewApplicationMailer $mailer
     */
    function __construct(Array $input, Model $job)
    {
        // set up variables
        $this->input = $input;
        $this->job = $job;
        $this->appRepo = new ApplicationsRepository;
        $this->userRepo = new UserRepository;
        $this->applyingUser = $this->userRepo->authedUser();
    }

    /**
     * Execute the command to Send New Application
     */
    public function execute()
    {
        // Need to get the path of either the new resume or default resume
        // if new resume included, upload it, else get the path to users default resume
        if(isset($this->input['resume']))
        {
            $path = $this->appRepo->uploadResume($this->input['resume']);
        }
        elseif($this->input['resume_radio_group'] == 'default_resume')
        {
            $path = $this->applyingUser->resume->path;
        }

        //get job admin user
        $adminUser = $this->userRepo->userById($this->job->user_id);

        //set up email variables
        $subject = 'New Application From EriePa.Jobs';
        $user_email = $this->job->email;
        $user_name = $adminUser->first_name.' '.$adminUser->last_name;
        $job_title = $this->job->title;

        //send email
        \Mail::queue('emails.applications.SendNewApplication', [ 'cover_letter' => $this->input['cover_letter'], 'job_title' => $job_title], function($message) use ($user_email, $user_name, $subject, $path)
        {
            $message->to($user_email, $user_name)->subject($subject);

            if($path != ''){
                $message->attach($path);
            }
        });

        \Event::fire('application.send', ['user' => $this->applyingUser, 'job' => $this->job, 'resume_path' => $path]);
    }
} 