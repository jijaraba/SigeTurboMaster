<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idroute');
            $table->integer('idvehicle')->unsigned();
            $table->integer('idconveyor')->unsigned();
            $table->integer('idcompanion')->unsigned();
            $table->string('name',50);
            $table->time('hour');
            $table->timestamps();
            $table->foreign('idvehicle')
                ->references('idvehicle')
                ->on('vehicles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idconveyor')
                ->references('idconveyor')
                ->on('conveyors')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idcompanion')
                ->references('idconveyor')
                ->on('conveyors')
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
        Schema::drop('routes');
    }
}