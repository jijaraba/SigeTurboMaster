<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObservertypesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('observertypes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idobservertype');
			$table->string('name');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('observertypes');
	}

}
