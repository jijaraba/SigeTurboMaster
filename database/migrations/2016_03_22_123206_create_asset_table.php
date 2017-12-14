<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idasset');
            $table->integer('idassetcategory')->unsigned();
            $table->integer('idprovider')->unsigned();
            $table->integer('code')->unique();
            $table->string('name');
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->text('description')->nullable();
            $table->double('cost', 15, 2);
            $table->date('acquired');
            $table->enum('verified', array('Y','N'))->default('N');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('verified_by')->nullable();
            $table->timestamps();
            $table->foreign('idassetcategory')
                ->references('idassetcategory')
                ->on('assetcategories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idprovider')
                ->references('idprovider')
                ->on('providers')
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
        Schema::drop('assets');
    }
}
