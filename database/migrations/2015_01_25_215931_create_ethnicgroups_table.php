<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEthnicgroupsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('ethnicgroups', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idethnicgroup');
			$table->string('name',45);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ethnicgroups');
	}

}
