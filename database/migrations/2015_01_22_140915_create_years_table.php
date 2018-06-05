<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateYearsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idyear');
            $table->integer('idcalendar')->unsigned();
            $table->string('name', 45);
            $table->string('prefix', 5);
            $table->date('starts');
            $table->date('ends');
            $table->date('preregistration_starts');
            $table->date('preregistration_ends');
            $table->timestamps();
            $table->foreign('idcalendar')
                ->references('idcalendar')
                ->on('calendars')
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
        Schema::drop('years');
    }

}
