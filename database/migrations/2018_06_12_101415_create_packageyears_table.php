<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageyearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packageyears', function (Blueprint $table) {
            $table->increments('idpackageyear');
            $table->integer('idyear')->unsigned();
            $table->integer('idpackage')->unsigned();
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idpackage')
                ->references('idpackage')
                ->on('packages')
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
        Schema::dropIfExists('packageyears');
    }
}
