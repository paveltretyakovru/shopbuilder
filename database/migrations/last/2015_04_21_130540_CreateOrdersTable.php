<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
			{
				$table->increments('id');
				$table->integer('user_id')->unsigned();							// id пользователя
				$table->foreign('user_id')->references('id')->on('users');

				$table->text('user_data');

				$table->integer('product_id')->unsigned();						// id товара
				$table->foreign('product_id')->references('id')->on('products');
				
				$table->integer('cart_id')->unsigned();							// id корзины
				$table->foreign('cart_id')->references('id')->on('carts');
				
				$table->boolean('confirmed')->default(false);					// подтвержден
				$table->boolean('paid')->default(false);						// оплачен
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
		//
	}

}
