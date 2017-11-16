<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateValidationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('validations', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idvalidation');
			$table->integer('idyear')->unsigned();
			$table->integer('idgrade')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idnivel')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('idassessment')->unsigned();
			$table->integer('idteacher')->unsigned();
			$table->integer('act');
			$table->text('observation')->nullabble();
			$table->datetime('validation_at')->nullable();
			$table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgrade')
                ->references('idgrade')
                ->on('grades')
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
            $table->foreign('idassessment')
                ->references('idassessment')
                ->on('assessments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idteacher')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idyear','idgrade','idsubject','idnivel','iduser','idteacher','act'),'validations_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('validations');
	}

}
