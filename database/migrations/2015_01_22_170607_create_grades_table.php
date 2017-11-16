<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('grades', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idgrade');
			$table->string('name', 60);
			$table->string('prefix',3);
			$table->text('description')->nullable();
			$table->enum('active', array('Y','N'))->default('Y');
			$table->integer('order');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('grades');
	}

}
