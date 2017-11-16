<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMonitoringtypeindicatorsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('monitoringtypeindicators', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idmonitoringtypeindicator');
			$table->integer('idmonitoringtype')->unsigned();
			$table->integer('idindicator')->unsigned();
			$table->timestamps();
			$table->foreign('idmonitoringtype')
				->references('idmonitoringtype')
				->on('monitoringtypes')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idindicator')
				->references('idindicator')
				->on('indicators')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->unique(array('idmonitoringtype','idindicator'),'monitoringtypeindicator_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('monitoringtypeindicators');
	}

}
