<?php

use EriePaJobs\Jobs\JobsRepository;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;

class DeleteSubscriptionJobs extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'jobs:subscription_end';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check for jobs that exist for cancelled subscribers and delete them.';


	/**
	 * Create a new command instance.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$userRepo = new \EriePaJobs\Users\UserRepository;
		$jobRepo = new JobsRepository;

		$users = User::where('subscription_ends_at', '!=', 'null')->get();

		foreach($users as $user)
		{
			if($user->cancelled() && $user->subscription_ends_at < Carbon::today())
			{
				$subscribedJobs = $userRepo->subscribedJobs($user);
				foreach($subscribedJobs as $job)
				{
					$jobRepo->deleteJob($job->id);
					$this->info('Subscription job "'.$job->title.'" deleted.');
				}
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
