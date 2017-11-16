<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnrollmentsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('enrollments', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idenrollment');
			$table->integer('idyear')->unsigned();
			$table->integer('idgroup')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('idstatusschooltype')->unsigned();
			$table->date('register');
			$table->enum('reentry',array('Y','N'))->default('N');
			$table->date('statusdate')->nullable();
			$table->decimal('scholarship',3,2);
			$table->enum('inclusion',array('Y','N'))->default('N');
			$table->enum('fieldtrip',array('Y','N'))->default('Y');
			$table->enum('isapprovedyear',array('Y','N'))->default('N');
			$table->text('observation')->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->foreign('idyear')
				->references('idyear')
				->on('years')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idgroup')
				->references('idgroup')
				->on('groups')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('iduser')
				->references('iduser')
				->on('users')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idstatusschooltype')
				->references('idstatusschooltype')
				->on('statusschooltypes')
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
		Schema::drop('enrollments');
	}

}
