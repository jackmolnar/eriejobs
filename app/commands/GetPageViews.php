<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GetPageViews extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'jobs:getPageViews';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Get the number of pageviews from Google Analytics';

	/**
	 * Create a new command instance.
	 *
	 * @return void
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
		$jobsRepo = new \EriePaJobs\Jobs\JobsRepository;
		$allJobs = $jobsRepo->allActiveJobs();

		$googleAnalytics = new \EriePaJobs\ClientLibraries\GoogleAnalytics($jobsRepo);

		foreach ($allJobs as $job)
		{
			$pageviews = $googleAnalytics->getViewsBySlug($job->slug);
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
