<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeofpromotionsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('typeofpromotions', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idtypeofpromotion');
			$table->string('name');
            $table->enum('active', array('Y','N'))->default('N');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('typeofpromotions');
	}

}
