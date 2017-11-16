<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idgroup');
			$table->integer('idgrade')->unsigned();
			$table->string('name',45);
			$table->integer('order');
			$table->enum('active',array('Y','N'))->default('Y');
			$table->timestamps();
			$table->foreign('idgrade')
				->references('idgrade')
				->on('grades')
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
		Schema::drop('groups');
	}

}
