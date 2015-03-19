<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->unique();
			$table->integer('price');
			$table->integer('count');
			$table->integer('category')->unsigned();
			$table->foreign('category')->references('id')->on('categories');
			$table->text('parameters')->nullable();
			$table->text('view')->nullable();
			$table->string('editview')->nullable();
			$table->boolean('visible')->dafault(true);
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
		Schema::drop('products');
	}

}
