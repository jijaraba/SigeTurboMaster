<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMonitoringtypesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('monitoringtypes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idmonitoringtype');
			$table->integer('idyear')->unsigned();
			$table->integer('idperiod')->unsigned();
			$table->integer('idgroup')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idnivel')->unsigned();
			$table->integer('idmonitoringcategory')->unsigned();
			$table->date('date');
			$table->string('name',256);
			$table->text('description')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
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
			$table->foreign('idgroup')
				->references('idgroup')
				->on('groups')
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
			$table->foreign('idmonitoringcategory')
				->references('idmonitoringcategory')
				->on('monitoringcategories')
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
		Schema::drop('monitoringtypes');
	}

}
