<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicatorcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicatorcategories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idindicatorcategory');
            $table->string('name');
            $table->string('prefix', 2);
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
        Schema::drop('indicatorcategories');
    }
}
