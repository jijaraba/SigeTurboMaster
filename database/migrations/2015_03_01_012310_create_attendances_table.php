<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendances', function(Blueprint $table)
		{
			$table->increments('idattendance');
			$table->integer('idyear')->unsigned();
			$table->integer('idperiod')->unsigned();
			$table->integer('idgroup')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idnivel')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('attendance');
            $table->enum('type',array('Present','Absent','Tardy','Excused','Missing'))->default('Present');
			$table->date('date');
			$table->time('time');
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idperiod')
                ->references('idperiod')
                ->on('periods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgroup')
                ->references('idgroup')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idsubject')
                ->references('idsubject')
                ->on('subjects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idnivel')
                ->references('idnivel')
                ->on('nivels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idyear','idperiod','idgroup','idsubject','idnivel','iduser','date'),'attendances_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendances');
	}

}
