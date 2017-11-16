<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subjects', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idsubject');
			$table->integer('idarea')->unsigned();
			$table->string('name',255);
			$table->string('shortname',45);
			$table->string('prefix',10);
			$table->timestamps();
			$table->foreign('idarea')
				->references('idarea')
				->on('areas')
				->onUpdate('cascade')
				->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subjects');
	}

}
