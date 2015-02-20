<?php

use EriePaJobs\Jobs\JobsRepository;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;

class DeleteExpiredJobs extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'jobs:expired';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check for expired jobs. If expired, delete them.';


    /**
     * Create a new command instance.
     *
     * @return \DeleteExpiredJobs
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
//        Queue::push(function($job)
//        {
            $jobsRepo = new JobsRepository;
            $allJobs = $jobsRepo->allJobs();
            foreach($allJobs as $currentJob)
            {
                if($currentJob->expire < Carbon::today())
                {
                    $jobsRepo->deleteJob($currentJob->id);
					$this->info('Expired jobs deleted.');
				} else {
					$this->info('No jobs have expired.');
				}
            }

//            $job->delete();
//        });
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
