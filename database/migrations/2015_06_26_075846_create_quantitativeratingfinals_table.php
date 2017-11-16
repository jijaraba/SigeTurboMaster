<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuantitativeratingfinalsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('quantitativeratingfinals', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idquantitativerating');
			$table->integer('idyear')->unsigned();
			$table->integer('idprovenance')->unsigned();
			$table->integer('idgroup')->unsigned();
			$table->integer('idsubject')->unsigned();
			$table->integer('idnivel')->unsigned();
			$table->integer('iduser')->unsigned();
            $table->decimal('rating',3,2);
			$table->timestamps();
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
            $table->unique(array('idyear','idprovenance','idgroup','idsubject','idnivel','iduser'),'quantitativeratingfinals_unique');
		});
	}

	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quantitativeratingfinals');
	}

}
