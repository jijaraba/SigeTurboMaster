<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuantitativevalidationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quantitativevalidations', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idquantitativevalidation');
			$table->integer('idyear')->unsigned();
			$table->integer('idgrade')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idnivel')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('idteacher')->unsigned();
            $table->decimal('rating',3,2);
			$table->integer('act');
			$table->text('observation')->nullable();
			$table->datetime('validation_at');
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
            $table->foreign('idteacher')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idyear','idgrade','idsubject','idnivel','iduser','idteacher','act'),'quantitativevalidations_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quantitativevalidations');
	}

}
