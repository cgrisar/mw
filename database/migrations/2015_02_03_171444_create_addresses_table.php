<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

		Schema::create('addresses', function(Blueprint $table){

			$table->increments('id');
			$table->string('address');
			$table->string('zip');
			$table->string('county');
			$table->string('country');
			$table->string('phone');
			$table->string('email');
			$table->string('contact');
			$table->integer('relationship_id')->unsigned();
			$table->foreign('relationship_id')->references('id')->on('relationships');
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
