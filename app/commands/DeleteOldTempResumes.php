<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeleteOldTempResumes extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'resumes:cleanup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete old temporary resumes.';

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
		$files = File::cleanDirectory(Config::get('resumes.temp_path'));
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
