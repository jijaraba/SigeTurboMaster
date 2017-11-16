<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePathstudentsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('pathstudents', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idpathstudent');
            $table->integer('idyear')->unsigned();
			$table->integer('idperiod')->unsigned();
            $table->integer('iduser')->unsigned();
			$table->string('path',128);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
		Schema::drop('pathstudents');
	}

}
			
			