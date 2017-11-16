<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTownsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('towns', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idtown');
			$table->integer('iddepartment')->unsigned();
			$table->string('name');
            $table->enum('area',array('Y','N'))->default('N');
			$table->timestamps();
			$table->foreign('iddepartment')
				->references('iddepartment')
				->on('departments')
				->onUpdate('cascade')
				->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('towns');
	}

}
