<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMonitoringsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('monitorings', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idmonitoring');
			$table->integer('idprovenance')->unsigned();
			$table->integer('idyear')->unsigned();
			$table->integer('idperiod')->unsigned();
			$table->integer('idgroup')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idnivel')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('idmonitoringtype')->unsigned();
			$table->decimal('rating',3,2);
			$table->text('observation')->nullable();
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->integer('monitoringable_id');
			$table->string('monitoringable_type')->default('Monitoringtype');
			$table->timestamps();
			$table->foreign('idprovenance')
				->references('idprovenance')
				->on('provenances')
				->onUpdate('cascade')
				->onDelete('cascade');
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
			$table->foreign('iduser')
				->references('iduser')
				->on('users')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idmonitoringtype')
				->references('idmonitoringtype')
				->on('monitoringtypes')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->unique(array('idprovenance','idyear','idperiod','idgroup','idsubject','iduser','idmonitoringtype'),'monitorings_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('monitorings');
	}

}
