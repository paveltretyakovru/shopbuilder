<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('fullname' , 50);
			$table->integer('phone')->unsigned();
			$table->string('city' , 50);
			$table->string('country' , 20);
			$table->integer('postcode')->unsigned();
			$table->text('address');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			//
		});
	}

}
