<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('departments', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('iddepartment');
			$table->integer('idcountry')->unsigned();
			$table->string('name',128);
			$table->timestamps();
			$table->foreign('idcountry')
				->references('idcountry')
				->on('countries')
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
		Schema::drop('departments');
	}

}
