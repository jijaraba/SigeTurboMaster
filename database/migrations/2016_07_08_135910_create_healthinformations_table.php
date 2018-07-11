<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthinformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healthinformations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idhealthinformation');
            $table->integer('iduser')->unsigned();
            $table->integer('idbloodtype')->unsigned();
            $table->integer('idprepaidmedical')->unsigned();
            $table->integer('idmedicalinsurance')->unsigned();
            $table->string('policy_number')->nullable();
            $table->enum('suffered_illness', ['Y', 'N'])->default('N');
            $table->text('diseases')->nullable();
            $table->enum('medical_treatment', ['Y', 'N'])->default('N');
            $table->text('medical_treatment_description')->nullable();
            $table->enum('equal_treatment', ['Y', 'N'])->default('N');
            $table->enum('take_medication', ['Y', 'N'])->default('N');
            $table->text('medication')->nullable();
            $table->text('why_take_medication')->nullable();
            $table->text('dose')->nullable();
            $table->enum('is_allergic', ['Y', 'N'])->default('N');
            $table->text('allergies')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('doctor_phone')->nullable();
            $table->enum('psychological_treatment', array('Y', 'N'))->default('N');
            $table->string('emergency_contact');
            $table->string('emergency_phone');
            $table->enum('insurance', array('Y', 'N'))->default('N');
            $table->enum('vaccination_card', array('Y', 'N'))->default('N');
            $table->text('observation')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idbloodtype')
                ->references('idbloodtype')
                ->on('bloodtypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idprepaidmedical')
                ->references('idprepaidmedical')
                ->on('prepaidmedicals')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idmedicalinsurance')
                ->references('idmedicalinsurance')
                ->on('medicalinsurances')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('iduser'), 'healthinformations_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('healthinformations');
    }
}
