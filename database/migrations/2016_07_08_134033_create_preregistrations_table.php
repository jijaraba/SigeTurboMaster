<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePreregistrationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preregistrations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idpreregistration');
            $table->integer('iduser')->unsigned();
            $table->integer('ididentificationtype')->unsigned();
            $table->integer('idreligion')->unsigned();
            $table->integer('idbloodtype')->unsigned();
            $table->integer('idfamily')->unsigned();
            $table->integer('idcategory')->unsigned();
            $table->integer('idmedicalinsurance')->unsigned();
            $table->integer('idprepaidmedical')->unsigned();
            $table->string('identification');
            $table->string('expedition');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address');
            $table->string('district');
            $table->string('town');
            $table->string('phone')->nullable();
            $table->string('celular');
            $table->string('email');

            $table->string('policynumber')->nullable();
            $table->enum('medicaltreatment', array('Y', 'N'))->default('N');
            $table->text('medicaltreatmentdescription')->nullable();
            $table->enum('equaltreatment', array('Y', 'N'))->default('N');
            $table->enum('takemedication', array('Y', 'N'))->default('N');
            $table->text('medicationdescription')->nullable();
            $table->text('whytakemedication')->nullable();
            $table->text('dose')->nullable();
            $table->enum('isallergic', array('Y', 'N'))->default('N');
            $table->text('specifyallergic')->nullable();
            $table->enum('sufferedillness', array('Y', 'N'))->default('N');
            $table->text('sufferedillnessdescription')->nullable();
            $table->string('doctorname')->nullable();
            $table->string('doctorphone')->nullable();
            $table->enum('psychologicalsupport', array('Y', 'N'))->default('N');

            $table->text('observation')->nullable();
            $table->enum('educationaloutput', array('Y', 'N'))->default('Y');
            $table->string('responsible')->nullable();

            $table->string('profession')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('phonecompany')->nullable();

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
            $table->foreign('idreligion')
                ->references('idreligion')
                ->on('religions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idbloodtype')
                ->references('idbloodtype')
                ->on('bloodtypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idfamily')
                ->references('idfamily')
                ->on('families')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idcategory')
                ->references('idcategory')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idmedicalinsurance')
                ->references('idmedicalinsurance')
                ->on('medicalinsurances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idprepaidmedical')
                ->references('idprepaidmedical')
                ->on('prepaidmedicals')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('iduser'), 'preregistration_unique');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preregistrations');
    }

}
