<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskfilesTable extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('taskfiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idtaskfile');
            $table->integer('idtask')->unsigned();
            $table->string('file');
            $table->string('realname');
            $table->integer('size');
            $table->string('extension');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('idtask')
                ->references('idtask')
                ->on('tasks')
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
        Schema::drop('taskfiles');
    }

}
