<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQualitativerecoveryfinalareasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('qualitativerecoveryfinalareas', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idqualitativerecoveryfinalarea');
			$table->integer('idyear')->unsigned();
            $table->integer('idprovenance')->unsigned();
			$table->integer('idgroup')->unsigned();
			$table->integer('idarea')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('idassessment')->unsigned();
			$table->integer('idteacher')->unsigned();
			$table->integer('act');
			$table->text('observation');
			$table->datetime('recovery_at');
			$table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idprovenance')
                ->references('idprovenance')
                ->on('provenances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgroup')
                ->references('idgroup')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idarea')
                ->references('idarea')
                ->on('areas')
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
            $table->unique(array('idyear','idprovenance','idgroup','idarea','iduser','act'),'qualitativerecoveryfinalareas_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('qualitativerecoveryfinalareas');
	}

}
