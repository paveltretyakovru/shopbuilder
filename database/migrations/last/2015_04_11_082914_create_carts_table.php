<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carts', function(Blueprint $table)
		{
			$table->increments('id');
			
			// Идентификатор товара
			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('products');

			// Идентификатор покупателя
			$table->integer('user_id')->unsigned();

			// Оформлен ли товар
			$table->boolean('checkout')->default(false);			

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
		Schema::drop('carts');
	}

}
