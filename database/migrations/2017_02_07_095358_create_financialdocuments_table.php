<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialdocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financialdocuments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idfinancialdocument');
            $table->string('documenttype');
            $table->integer('consecutive');
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
        Schema::drop('financialdocuments');
    }
}
