<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationusersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notificationusers', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idnotificationuser');
			$table->integer('idnotification')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->enum('state',array('Read','Unread'))->default('Unread');
			$table->timestamps();
            $table->softDeletes();
            $table->foreign('idnotification')
                ->references('idnotification')
                ->on('notifications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idnotification','iduser'),'notifications_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notificationusers');
	}

}
