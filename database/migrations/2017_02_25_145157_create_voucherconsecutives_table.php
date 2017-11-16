<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherconsecutivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucherconsecutives', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idvoucherconsecutive');
            $table->integer('idvouchertype')->unsigned();
            $table->string('documenttype');
            $table->integer('consecutive');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idvouchertype')
                ->references('idvouchertype')
                ->on('vouchertypes')
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
        Schema::drop('voucherconsecutives');
    }
}
