<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolinformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolinformations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idschoolinformation');
            $table->integer('iduser')->unsigned();
            $table->integer('idcalendar')->unsigned();
            $table->integer('idgrade')->unsigned();
            $table->integer('idenrollmentreason')->unsigned();
            $table->string('school');
            $table->string('ubication');
            $table->string('phone');
            $table->enum('approved',array('Y','N'))->default('Y');
            $table->text('observation');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idcalendar')
                ->references('idcalendar')
                ->on('calendars')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgrade')
                ->references('idgrade')
                ->on('grades')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idenrollmentreason')
                ->references('idenrollmentreason')
                ->on('enrollmentreasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('iduser'),'schoolinformations_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schoolinformations');
    }
}
