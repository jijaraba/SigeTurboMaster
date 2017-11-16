<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('academics', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idacademic');
			$table->integer('idyear')->unsigned();
			$table->integer('idperiod')->unsigned();
			$table->integer('idcalendar')->unsigned();
			$table->date('starts');
			$table->date('ends');
			$table->date('rating')->nullable();
			$table->date('review')->nullable();
			$table->date('print')->nullable();
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
            $table->foreign('idcalendar')
                ->references('idcalendar')
                ->on('calendars')
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
		Schema::drop('academics');
	}

}
