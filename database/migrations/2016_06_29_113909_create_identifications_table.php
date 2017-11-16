<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ididentification');
            $table->integer('ididentificationtype')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->string('identification')->unique();
            $table->string('expedition');
            $table->date('date');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('ididentificationtype')
                ->references('ididentificationtype')
                ->on('identificationtypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('iduser'),'identifications_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('identifications');
    }
}
