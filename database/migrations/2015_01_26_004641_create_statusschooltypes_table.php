<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatusschooltypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statusschooltypes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idstatusschooltype');
			$table->string('name',128);
			$table->integer('duration')->nullable();
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
		Schema::drop('statusschooltypes');
	}

}
