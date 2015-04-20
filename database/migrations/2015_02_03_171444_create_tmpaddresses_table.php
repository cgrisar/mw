<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpAddressesTable extends Migration {

	/**
	 * Create a temporary adresses Table
	 * This table acts like a buffer between dataTables and the permanent
	 * addresses Table
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::create('tmpAddresses', function(Blueprint $table){

			$table->increments('id');
			$table->string('address');
			$table->string('zip');
			$table->string('county');
			$table->string('country');
			$table->string('phone');
			$table->string('email');
			$table->string('contact');
			$table->integer('customer_id')->unsigned();
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
		Schema::drop('addresses');
	}

}
