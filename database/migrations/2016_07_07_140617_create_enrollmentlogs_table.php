<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollmentlogs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idenrollmentlog');
            $table->integer('idenrollment')->unsigned();
            $table->text('description');
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->foreign('idenrollment')
                ->references('idenrollment')
                ->on('enrollments')
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
        Schema::drop('enrollmentlogs');
    }
}
