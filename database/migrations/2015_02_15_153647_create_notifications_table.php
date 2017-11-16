<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idnotification');
			$table->string('name');
			$table->text('description');
			$table->date('starts');
			$table->date('ends');
			$table->enum('flag',array(1,2,3))->default(1);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications');
	}

}
