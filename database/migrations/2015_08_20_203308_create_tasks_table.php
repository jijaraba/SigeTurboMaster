<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTasksTable extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idtask');
            $table->integer('idyear')->unsigned();
            $table->integer('idperiod')->unsigned();
            $table->integer('idgroup')->unsigned();
            $table->integer('idsubject')->unsigned();
            $table->integer('idnivel')->unsigned();
            $table->integer('idtasktype')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->date('starts');
            $table->date('ends');
            $table->integer('days');
            $table->enum('status',array(0,1))->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idperiod')
                ->references('idperiod')
                ->on('periods')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgroup')
                ->references('idgroup')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idsubject')
                ->references('idsubject')
                ->on('subjects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idnivel')
                ->references('idnivel')
                ->on('nivels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idtasktype')
                ->references('idtasktype')
                ->on('tasktypes')
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
        Schema::drop('tasks');
    }

}
