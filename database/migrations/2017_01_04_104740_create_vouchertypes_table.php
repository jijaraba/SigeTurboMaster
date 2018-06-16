<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchertypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchertypes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idvouchertype');
            $table->integer('idvouchercategory')->unsigned();
            $table->string('name');
            $table->string('code');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idvouchercategory')
                ->references('idvouchercategory')
                ->on('vouchercategories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('code'), 'vouchertypes_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vouchertypes');
    }
}
