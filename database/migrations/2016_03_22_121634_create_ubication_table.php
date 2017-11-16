<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idubication');
            $table->integer('iduser')->unsigned();
            $table->string('sector');
            $table->string('code');
            $table->string('name');
            $table->enum('classroom', array('Y','N'))->default('N');
            $table->enum('bookable', array('Y','N'))->default('N');
            $table->enum('verified', array('Y','N'))->default('N');
            $table->timestamps();
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
        Schema::drop('ubications');
    }
}
