<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFoliosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('folios', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idfolio');
			$table->integer('idyear')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('idtypeofpromotion')->unsigned();
			$table->integer('folio');
			$table->text('observation')->nullable();
			$table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idtypeofpromotion')
                ->references('idtypeofpromotion')
                ->on('typeofpromotions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idyear','iduser','idtypeofpromotion','folio'),'folios_unique');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('folios');
	}

}
