<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicatortypesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('indicatortypes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idindicatortype');
			$table->string('name',128);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('indicatortypes');
	}

}
