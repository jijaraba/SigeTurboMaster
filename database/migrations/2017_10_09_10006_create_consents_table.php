<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsentsTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('consents', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idconsent');
            $table->integer('iduser')->unsigned();
            $table->integer('idconsenttype')->unsigned();
			$table->string('path',128);
			$table->timestamps();
			$table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idconsenttype')
                ->references('idconsenttype')
                ->on('consenttypes')
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
		Schema::drop('consents');
	}

}
			
			