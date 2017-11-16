<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreamanagersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areamanagers', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idareamanager');
			$table->integer('idyear')->unsigned();
			$table->integer('idarea')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->timestamps();
			$table->foreign('idyear')
				->references('idyear')
				->on('years')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idarea')
				->references('idarea')
				->on('areas')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('iduser')
				->references('iduser')
				->on('users')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->unique(array('idyear','idarea','iduser'),'areamanagers_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('areamanagers');
	}

}
