<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationpurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluationpurchases', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('idevaluationpurchase');
            $table->integer('idpurchase')->unsigned();
            $table->decimal('opportunity',5,1);
            $table->decimal('quality',5,1);
            $table->decimal('service',5,1);
            $table->decimal('total',5,2);
            $table->text('observation')->nullable();
            $table->integer('created_by')->nullable();
			$table->timestamps();
            $table->foreign('idpurchase')
                ->references('idpurchase')
                ->on('purchases')
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
		Schema::drop('evaluationpurchases');
	}

}
