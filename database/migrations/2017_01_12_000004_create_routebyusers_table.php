<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutebyusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routebyusers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idroutebyuser');
            $table->integer('idroute')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->timestamps();
            $table->foreign('idroute')
                ->references('idroute')
                ->on('routes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idroute','iduser'),'route_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('routebyusers');
    }
}