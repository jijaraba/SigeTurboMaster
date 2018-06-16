<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostpackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costpackages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idcostpackage');
            $table->integer('idpackage')->unsigned();
            $table->integer('idaccounttype')->unsigned();
            $table->integer('idvouchercategory')->unsigned()->default(1);
            $table->integer('idtransactiontype')->unsigned();
            $table->double('percentage', 15, 2);
            $table->string('calculated')->nullable();
            $table->integer('factor')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idpackage')
                ->references('idpackage')
                ->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idaccounttype')
                ->references('idaccounttype')
                ->on('accounttypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idvouchercategory')
                ->references('idvouchercategory')
                ->on('vouchercategories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idtransactiontype')
                ->references('idtransactiontype')
                ->on('transactiontypes')
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
        Schema::drop('costpackages');
    }
}
