<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancebyemployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendancebyemployees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idattendancebyemployee');
            $table->integer('iduser')->unsigned();
            $table->enum('attendancetype', array('E','O'))->default('E');
            $table->date('date');
            $table->time('time');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attendancebyemployees');
    }
}
