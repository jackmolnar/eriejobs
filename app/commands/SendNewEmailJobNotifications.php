<?php

use EriePaJobs\Jobs\JobsRepository;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendNewEmailJobNotifications extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'notifications:sendEmailNotifications';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sends new job listings (posted within last week) to email notification subscribers.';
    protected $jobsRepo;

    /**
     * Create a new command instance.
     *
     * @internal param JobsRepository $jobsRepo
     */
	public function __construct()
	{
		parent::__construct();

        $this->jobsRepo = new JobsRepository;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{

		$allUsers = User::emailNotifications()->get();

        foreach($allUsers as $user)
        {
            //get users notifications
            $notifications = $user->jobNotifications->all();

            //create array
            $resultsArray = [];

            foreach($notifications as $notification)
            {
                $searchResults = $this->jobsRepo->searchForJob($notification->term, 5);

                $searchResults = $searchResults->toArray();

                //remove listings more than 1 days old from array
                $searchResults = $this->getNewListings($searchResults);

                //if results, add to the resultsArray
                if(count($searchResults))
                {
                    foreach($searchResults as $result)
                    {
                        $resultsArray[] = $result['id'];
                    }

                    //  \/ this can go
//                    $resultsArray[$notification->term] = $searchResults;
                }
            }

            //if results for any notification term, send mailer
            if(count($resultsArray))
            {
                $emailInfo = [
                    'subject' => 'New Job Listings Posted',
                    'user_email' => $user->email,
                    'user_name' => $user->first_name.' '.$user->last_name
                ];
                //  \/ this can go
//                $subject = 'New Job Listings Posted';
//                $user_email = $user->email;
//                $user_first_name = $user->first_name;
//                $user_last_name = $user->last_name;
//                $user_name = $user_first_name.' '.$user_last_name;

                Queue::push('EriePaJobs\QueueHandlers\SendJobNotificationEmail', array('jobIds' => $resultsArray, 'emailInfo' => $emailInfo));

                $this->info('New job notifications sent. User id '. $user->id);
            } else {
                $this->info('No job notifications sent. User id '. $user->id);
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
        //remove listings more than 1 days old from array
        $searchResults = array_filter($searchResults, function($result){
            if($result['created_at'] > Carbon::today()->subDays(1))
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
