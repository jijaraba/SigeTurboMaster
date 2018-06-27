<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsibleparentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsibleparents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idresponsibleparent');
            $table->integer('iduser')->unsigned();
            $table->integer('responsible');
            $table->string('responsible_name')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
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
        Schema::drop('responsibleparents');
    }
}
