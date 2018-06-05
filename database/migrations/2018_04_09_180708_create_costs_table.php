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
            $table->integer('idconcepttype')->unsigned();
            $table->integer('idaccounttype')->unsigned();
            $table->double('value', 15, 2);
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
            $table->foreign('idconcepttype')
                ->references('idconcepttype')
                ->on('concepttypes')
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
        Schema::drop('costs');
    }
}
