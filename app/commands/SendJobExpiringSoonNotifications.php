<?php

use EriePaJobs\Jobs\JobsRepository;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendJobExpiringSoonNotifications extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'notifications:sendJobsExpiringSoonNotifications';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sends notifications to recruiters whose listings expire soon.';

	protected $jobsRepo;

	/**
	 * Create a new command instance.
	 *
	 * @return void
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
		//get all jobs
		$allJobs = $this->jobsRepo->allJobs();

		$triggerDate = Carbon::today()->addDays(3);

		foreach($allJobs as $job)
		{
			// set 24 hour period
			$second = $job->expire;
			$first = $job->expire->subDays(1);

			// if trigger date is between 24 hour period, send expire soon email
			if( $triggerDate->between($first, $second) )
			{
				Queue::push('EriePaJobs\QueueHandlers\SendJobExpiringSoonEmail', array('jobid' => $job->id));
				$this->info('Expiring soon email sent to '. $job->title);
			}
		}
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
