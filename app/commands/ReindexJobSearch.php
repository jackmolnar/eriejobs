<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ReindexJobSearch extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'jobs:reindexJobSearch';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Reindex the job index for search.';

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
		Job::where('active', '=', 1)->get()->reindex();
        $this->info('Job index reindexed.');
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
