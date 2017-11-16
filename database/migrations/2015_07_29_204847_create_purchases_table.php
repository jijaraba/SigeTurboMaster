<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idpurchase');
            $table->integer('idprovider')->unsigned();
            $table->integer('idstatuspurchase')->unsigned();
            $table->integer('iduser')->unsigned();
			$table->string('code');
			$table->date('date');
			$table->integer('leadtime')->default(1);
			$table->date('delivery')->nullable();
			$table->string('budget');
            $table->decimal('discount', 2, 2)->default(0.00);
			$table->text('observation')->nullable();
			$table->timestamps();
            $table->foreign('idprovider')
                ->references('idprovider')
                ->on('providers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idstatuspurchase')
                ->references('idstatuspurchase')
                ->on('statuspurchases')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
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
		Schema::drop('purchases');
	}

}
