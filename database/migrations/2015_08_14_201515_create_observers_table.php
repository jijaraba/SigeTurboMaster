<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObserversTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('observers', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idobserver');
			$table->integer('idyear')->unsigned();
			$table->integer('idgroup')->unsigned();
			$table->integer('idobservertype')->unsigned();
			$table->integer('iduser')->unsigned();
			$table->integer('idteacher')->unsigned();
			$table->text('observer');
			$table->dateTime('observed_at');
			$table->string('tags')->default('General');
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
			$table->foreign('idobservertype')
				->references('idobservertype')
				->on('observertypes')
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
		});
	}


	/**
	 * Reverse the migrations.
	 * @return void
	 */
	public function down()
	{
		Schema::drop('observers');
	}

}
