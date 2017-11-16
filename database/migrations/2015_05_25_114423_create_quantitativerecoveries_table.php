<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuantitativerecoveriesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('quantitativerecoveries', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idquantitativerecovery');
            $table->integer('idprovenance')->unsigned()->default(1);
            $table->integer('idyear')->unsigned();
            $table->integer('idperiod')->unsigned();
            $table->integer('idgroup')->unsigned();
            $table->integer('idsubject')->unsigned();
            $table->integer('idnivel')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->decimal('rating',3,2);
            $table->string('folio');
            $table->text('description')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
			$table->timestamps();
            $table->foreign('idprovenance')
                ->references('idprovenance')
                ->on('provenances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
            $table->unique(array('idprovenance','idyear','idperiod','idgroup','idsubject','iduser'),'quantitativerecovery_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quantitativerecoveries');
	}

}
