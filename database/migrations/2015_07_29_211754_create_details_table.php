<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('iddetail');
            $table->integer('idpurchase')->unsigned();
            $table->integer('idproduct')->unsigned();
            $table->integer('quantity');
            $table->double('cost', 15, 2);
            $table->double('total', 15, 2);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('idpurchase')
                ->references('idpurchase')
                ->on('purchases')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idproduct')
                ->references('idproduct')
                ->on('products')
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
        Schema::drop('details');
    }

}
