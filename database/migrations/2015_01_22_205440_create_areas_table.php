<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreasTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idarea');
			$table->string('name',255);
			$table->string('shortname',45);
			$table->string('prefix',4);
			$table->text('description')->nullable();
			$table->enum('isPrinteable',array('Y','N'))->default('Y');
			$table->integer('order');
			$table->enum('active',array('Y','N'))->default('Y');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('areas');
	}

}
