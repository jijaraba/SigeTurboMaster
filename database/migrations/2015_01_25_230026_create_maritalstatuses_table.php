<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaritalstatusesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('maritalstatuses', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idmaritalstatus');
			$table->string('name',45);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maritalstatuses');
	}

}
