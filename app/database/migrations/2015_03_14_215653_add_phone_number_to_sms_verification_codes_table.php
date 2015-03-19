<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPhoneNumberToSmsVerificationCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sms_verification_codes', function(Blueprint $table)
		{
			$table->integer('phone_number');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sms_verification_codes', function(Blueprint $table)
		{
			$table->removeColumn('phone_number');
		});
	}

}
