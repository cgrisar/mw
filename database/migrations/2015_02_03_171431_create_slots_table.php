<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('slots', function(Blueprint $table){
			$table->increments('id');
			$table->string('address')->unique();
			$table->boolean('excise');
			$table->integer('capacity');
			$table->integer('warehouse_id')->unsigned();
			$table->foreign('warehouse_id')->references('id')->on('warehouses');
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
		Schema::drop('slots');
	}

}
