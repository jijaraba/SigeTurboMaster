<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAchievementsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('achievements', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idachievement');
			$table->integer('idyear')->unsigned();
			$table->integer('idperiod')->unsigned();
			$table->integer('idgrade')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idnivel')->unsigned();
			$table->text('achievement');
			$table->timestamps();
			$table->foreign('idyear')
				->references('idyear')
				->on('years')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idperiod')
				->references('idperiod')
				->on('periods')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idgrade')
				->references('idgrade')
				->on('grades')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idsubject')
				->references('idsubject')
				->on('subjects')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idnivel')
				->references('idnivel')
				->on('nivels')
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
		Schema::drop('achievements');
	}

}
