<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeeklyevaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weeklyevaluations', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idweeklyevaluation');
			$table->integer('idyear')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('week');
			$table->text('comment');
			$table->timestamps();
			$table->foreign('idyear')
				->references('idyear')
				->on('years')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('iduser')
				->references('iduser')
				->on('users')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->unique(array('idyear','iduser','week'),'weeklyevaluations_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('weeklyevaluations');
	}

}
