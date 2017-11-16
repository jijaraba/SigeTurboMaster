<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idcost');
            $table->integer('idyear')->unsigned();
            $table->integer('idgrade')->unsigned();
            $table->integer('enrollment');
            $table->integer('enrollment_discount')->nullable();
            $table->integer('enrollment_expired')->nullable();
            $table->integer('pension_discount')->nullable();
            $table->integer('pension_normal');
            $table->integer('pension_expired')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgrade')
                ->references('idgrade')
                ->on('grades')
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
        Schema::drop('costs');
    }
}
