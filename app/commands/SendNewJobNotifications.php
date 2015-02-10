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
                Queue::push('EriePaJobs\QueueHandlers\SendNewJobNotificationsHandler', array('user' => $user, 'results' => $resultsArray));
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
