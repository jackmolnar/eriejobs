<?php
/**
 * Created by PhpStorm.
 * User: jackmolnar1982
 * Date: 11/1/14
 * Time: 8:15 PM
 */

namespace EriePaJobs\Applications;

use EriePaJobs\BaseCommand;
use EriePaJobs\Mailers\SendNewApplicationMailer;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SendNewApplicationCommand extends BaseCommand{

    protected $input;
    protected $resume;
    protected $job;
    protected $appRepo;
    /**
     * @var SendNewApplicationMailer
     */
    protected $newAppMailer;

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

        //create the mailer and appRepo
        $this->newAppMailer = new SendNewApplicationMailer;
        $this->appRepo = new ApplicationsRepository;
    }

    /**
     * Execute the command to Send New Application
     */
    public function execute()
    {
        $path = $this->appRepo->uploadResume($this->resume);

        $adminUser = \User::find($this->job->user_id);

        $this->newAppMailer->sendTo($adminUser,
            'New Application From EriePa.Jobs',
            'emails.applications.SendNewApplication',
            [ 'cover_letter' => $this->input['cover_letter'], 'job' => $this->job],
            $path
        );

        \Event::fire('application.send', ['user' => \Auth::user(), 'job' => $this->job, 'resume_path' => $path]);
    }
} 