<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReaderJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reader_jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 100);
			$table->text('description');
			$table->integer('reader_date_id');
			$table->integer('reader_heading_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reader_jobs');
	}

}
