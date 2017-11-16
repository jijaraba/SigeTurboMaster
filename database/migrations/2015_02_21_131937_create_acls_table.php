<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAclsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('acls', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idacl');
			$table->string('route');
			$table->string('roles');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acls');
	}

}
