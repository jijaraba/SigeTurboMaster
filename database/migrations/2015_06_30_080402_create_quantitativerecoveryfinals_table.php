<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuantitativerecoveryfinalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantitativerecoveryfinals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idquantitativerecoveryfinal');
            $table->integer('idyear')->unsigned();
            $table->integer('idprovenance')->unsigned();
            $table->integer('idgroup')->unsigned();
            $table->integer('idsubject')->unsigned();
            $table->integer('idnivel')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->integer('idteacher')->unsigned();
            $table->decimal('rating', 3, 2);
            $table->integer('act');
            $table->datetime('recovery_at');
            $table->text('observation')->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idprovenance')
                ->references('idprovenance')
                ->on('provenances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgroup')
                ->references('idgroup')
                ->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idsubject')
                ->references('idsubject')
                ->on('subjects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idnivel')
                ->references('idnivel')
                ->on('nivels')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idteacher')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idyear', 'idprovenance', 'idgroup', 'idsubject', 'idnivel', 'iduser', 'act'), 'quantitativerecoveryfinals_unique');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quantitativerecoveryfinals');
    }

}
