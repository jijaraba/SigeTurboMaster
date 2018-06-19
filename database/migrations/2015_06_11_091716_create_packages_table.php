<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idpackage');
            $table->integer('idconcepttype')->unsigned();
            $table->integer('code')->unique();
            $table->string('name');
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->enum('modifiable', ['Y', 'N'])->default('N');
            $table->enum('process', ['normal', 'advance'])->default('normal');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idconcepttype')
                ->references('idconcepttype')
                ->on('concepttypes')
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
        Schema::drop('packages');
    }
}
