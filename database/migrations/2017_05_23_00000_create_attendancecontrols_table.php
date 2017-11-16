<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancecontrolsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendancecontrols', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idattendancecontrol');
            $table->integer('idyear')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->date('date');
            $table->time('hour');
            $table->text('observation')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
			$table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendancecontrols');
	}

}
