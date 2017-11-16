<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitors', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('idvisitor');
			$table->integer('idvisitortype')->unsigned();
			$table->integer('ididentificationtype')->unsigned();
			$table->string('code')->nullable();
			$table->string('name');
			$table->integer('identification');
			$table->enum('gender',array(0,1))->default(0);
			$table->string('company')->nullable();
			$table->string('accesstype');
			$table->string('licenseplate')->nullable();
			$table->date('date');
			$table->time('time');
			$table->string('destination');
			$table->date('realdate');
			$table->time('checkin')->nullable();
			$table->time('checkout')->nullable();
			$table->text('observation')->nullable();
			$table->integer('created_by');
			$table->integer('updated_by')->nullable();
			$table->timestamps();
			$table->foreign('idvisitortype')
				->references('idvisitortype')
				->on('visitortypes')
				->onUpdate('cascade')
				->onDelete('cascade');
			$table->foreign('ididentificationtype')
				->references('ididentificationtype')
				->on('identificationtypes')
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
		Schema::drop('visitors');
	}

}
