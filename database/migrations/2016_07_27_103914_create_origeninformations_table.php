<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrigeninformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('origeninformations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idorigeninformation');
            $table->integer('iduser')->unsigned();
            $table->integer('idlanguage')->unsigned();
            $table->integer('idcountry')->unsigned();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idlanguage')
                ->references('idlanguage')
                ->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idcountry')
                ->references('idcountry')
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('iduser'),'origeninformations_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('origeninformations');
    }
}
