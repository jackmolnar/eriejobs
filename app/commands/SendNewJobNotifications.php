<?php

use EriePaJobs\Jobs\JobsRepository;
use EriePaJobs\Mailers\NewJobsNotificationMailer;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendNewJobNotifications extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'notifications:sendNewJobs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sends new job listings to notification subscribers.';
    protected $jobsRepo;
    protected $mailer;

    /**
     * Create a new command instance.
     *
     * @internal param JobsRepository $jobsRepo
     * @return \SendNewJobNotifications
     */
	public function __construct()
	{
		parent::__construct();

        $this->jobsRepo = new JobsRepository;

        $this->mailer = new NewJobsNotificationMailer;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		$allUsers = User::all();

        foreach($allUsers as $user)
        {
            //get users notifications
            $notifications = $user->jobNotifications->all();

            //build array
            $resultsArray = [];

            foreach($notifications as $notification)
            {
                $searchResults = $this->jobsRepo->searchForJob($notification->term, 5);

                $searchResults = $searchResults->toArray();

                //remove listings more than 7 days old from array
                $searchResults = $this->getNewListings($searchResults);

                //if results, add to the resultsArray
                if(count($searchResults))
                {
                    $resultsArray[$notification->term] = $searchResults;
                }
            }

            //if results for any notification term, send mailer
            if(count($resultsArray))
            {
                $subject = 'New Job Listings Posted';
                $user_email = $user->email;
                $user_first_name = $user->first_name;
                $user_last_name = $user->last_name;
                $user_name = $user_first_name.' '.$user_last_name;

                \Mail::queue('emails.notifications.NewJobsPosted', ['first_name' => $user_first_name, 'jobData' => $resultsArray], function($message) use ($user_email, $user_name, $subject)
                {
                    $message->to($user_email, $user_name)->subject($subject);
                });
                $this->info('New job notifications sent.');
            } else {
                $this->info('No job notifications sent.');
            }
        }
	}

    /**
     * Filter through search results, only return listings posted in last 7 days
     * @param $searchResults
     * @return array
     */
    public function getNewListings($searchResults)
    {
        //remove listings more than 7 days old from array
        $searchResults = array_filter($searchResults, function($result){
            if($result['created_at'] > Carbon::today()->subDays(7))
            {
                return $result;
            }
        });
        return $searchResults;
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
