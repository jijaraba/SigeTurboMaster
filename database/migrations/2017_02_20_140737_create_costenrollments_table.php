<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostenrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costenrollments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idcostenrollment');
            $table->integer('idpackage')->unsigned();
            $table->integer('idcost')->unsigned();
            $table->integer('idaccounttype')->unsigned();
            $table->double('value_discount', 11, 2);
            $table->double('value_normal', 11, 2);
            $table->double('value_expired', 11, 2);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idcost')
                ->references('idcost')
                ->on('costs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idpackage')
                ->references('idpackage')
                ->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idaccounttype')
                ->references('idaccounttype')
                ->on('accounttypes')
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
        Schema::drop('costenrollments');
    }
}
