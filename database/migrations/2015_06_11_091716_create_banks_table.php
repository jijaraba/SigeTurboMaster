<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idbank');
            $table->integer('idaccounttype')->unsigned();
            $table->integer('idcostcenter')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('idcostcenter')
                ->references('idcostcenter')
                ->on('costcenters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idaccounttype')
                ->references('idaccounttype')
                ->on('accounttypes')
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
        Schema::drop('banks');
    }
}
