<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMonitoringcategorybyyearsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('monitoringcategorybyyears', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idmonitoringcategorybyyear');
			$table->integer('idyear')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idmonitoringcategory')->unsigned();
			$table->decimal('percent',3,2);
			$table->timestamps();
			$table->foreign('idyear')
				->references('idyear')
				->on('years')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idsubject')
				->references('idsubject')
				->on('subjects')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idmonitoringcategory')
				->references('idmonitoringcategory')
				->on('monitoringcategories')
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
		Schema::drop('monitoringcategorybyyears');
	}

}
