<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserfamiliesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('userfamilies', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('iduserfamily');
			$table->integer('iduser')->unsigned();
			$table->integer('idfamily')->unsigned();
			$table->timestamps();
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idfamily')
                ->references('idfamily')
                ->on('families')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('iduser','idfamily'),'userfamily_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('userfamilies');
	}

}
