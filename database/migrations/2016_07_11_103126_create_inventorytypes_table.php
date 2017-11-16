<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorytypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventorytypes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idinventorytype');
            $table->string('name',60);
            $table->date('starts');
            $table->date('ends');
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
        Schema::drop('inventorytypes');
    }
}
