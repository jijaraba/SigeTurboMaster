<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNivelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nivels', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idnivel');
			$table->integer('idsubject')->unsigned();
			$table->string('name',128);
			$table->timestamps();
			$table->foreign('idsubject')
				->references('idsubject')
				->on('subjects')
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
		Schema::drop('nivels');
	}

}
