<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('indicators', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idindicator');
			$table->integer('idachievement')->unsigned();
			$table->integer('consecutive');
			$table->integer('idindicatortype')->unsigned();
			$table->integer('idindicatorcategory')->unsigned();
			$table->string('indicator');
			$table->timestamps();
			$table->foreign('idachievement')
				->references('idachievement')
				->on('achievements')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idindicatortype')
				->references('idindicatortype')
				->on('indicatortypes')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('idindicatorcategory')
				->references('idindicatorcategory')
				->on('indicatorcategories')
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
		Schema::drop('indicators');
	}

}
