<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetcategoryTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('assetcategories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idassetcategory');
            $table->integer('idassettype')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->foreign('idassettype')
                ->references('idassettype')
                ->on('assettypes')
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
        Schema::drop('assetcategories');
    }
}
