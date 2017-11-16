<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvidersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idprovider');
            $table->string('name');
            $table->string('nit')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('web')->nullable();
            $table->text('observation')->nullable();
            $table->text('services')->nullable();
            $table->integer('leadtime');
            $table->integer('paymentform');
            $table->decimal('evaluation',2,2)->default(0);
            $table->date('date');
            $table->string('company_ref1');
            $table->string('contact_ref1');
            $table->string('phone_ref1');
            $table->text('observation_ref1');
            $table->decimal('evaluation_ref1',2,2)->default(0);
            $table->string('company_ref2');
            $table->string('contact_ref2');
            $table->string('phone_ref2');
            $table->text('observation_ref2');
            $table->decimal('evaluation_ref2',2,2)->default(0);
            $table->string('company_ref3');
            $table->string('contact_ref3');
            $table->string('phone_ref3');
            $table->text('observation_ref3');
            $table->decimal('evaluation_ref3',2,2)->default(0);
            $table->string('term');
            $table->decimal('term_value',2,2)->default(0);
            $table->decimal('discount_commercial_value',2,2)->default(0);
            $table->decimal('discount_payment_value',2,2)->default(0);
            $table->string('experience');
            $table->decimal('experience_value',2,2)->default(0);
            $table->enum('warranty',array(0,1))->default(0);
            $table->decimal('warranty_value',2,2)->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('providers');
    }

}
