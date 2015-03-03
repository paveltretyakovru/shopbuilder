<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parameters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('unit')->nullable();
			
			$table->integer('product')->unsigned();
			$table->foreign('product')->references('id')->on('products');

			$table->integer('category')->unsigned();
			$table->foreign('category')->references('id')->on('categories');

			$table->text('hint')->nullable();

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
		Schema::drop('parameters');
	}

}
