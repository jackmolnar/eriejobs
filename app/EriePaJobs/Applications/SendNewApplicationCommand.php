<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/1/14
 * Time: 8:15 PM
 */

namespace EriePaJobs\Applications;

use EriePaJobs\BaseCommand;
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
    function __construct(Array $input, UploadedFile $resume, Model $job)
    {
        // set up variables
        $this->input = $input;
        $this->resume = $resume;
        $this->job = $job;

        $this->appRepo = new ApplicationsRepository;
    }

    /**
     * Execute the command to Send New Application
     */
    public function execute()
    {
        //upload resume
        $path = $this->appRepo->uploadResume($this->resume);

        //get job admin user
        $adminUser = \User::find($this->job->user_id);

        //set up email variables
        $subject = 'New Application From EriePa.Jobs';
        $user_email = $adminUser->email;
        $user_first_name = $adminUser->first_name;
        $user_last_name = $adminUser->last_name;
        $user_name = $user_first_name.' '.$user_last_name;
        $job_title = $this->job->title;

        //send email
        \Mail::queue('emails.applications.SendNewApplication', [ 'cover_letter' => $this->input['cover_letter'], 'job_title' => $job_title], function($message) use ($user_email, $user_name, $subject, $path)
        {
            $message->to($user_email, $user_name)->subject($subject);

            if($path != ''){
                $message->attach($path);
            }
        });

        \Event::fire('application.send', ['user' => \Auth::user(), 'job' => $this->job, 'resume_path' => $path]);
    }
} 