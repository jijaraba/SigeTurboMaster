<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupdirectorsTable extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('groupdirectors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idgroupdirector');
            $table->integer('idyear')->unsigned();
            $table->integer('idgroup')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgroup')
                ->references('idgroup')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('groupdirectors');
    }

}
