<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{

    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idpayment');
            $table->integer('idyear')->unsigned();
            $table->integer('idpaymenttype')->unsigned();
            $table->integer('idpackage')->unsigned();
            $table->integer('idbank')->unsigned();
            $table->integer('idfamily')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->enum('method', array('discount', 'normal', 'expired', 'agreement'))->default('normal');
            $table->string('concept1');
            $table->integer('value1');
            $table->date('date1');
            $table->text('observation1');
            $table->string('concept2');
            $table->integer('value2');
            $table->date('date2');
            $table->text('observation2');
            $table->string('concept3')->nullable();
            $table->integer('value3')->nullable();
            $table->date('date3')->nullable();
            $table->text('observation3')->nullable();
            $table->string('concept4')->nullable();
            $table->integer('value4')->nullable();
            $table->date('date4')->nullable();
            $table->text('observation4')->nullable();
            $table->string('transaccionId')->nullable();
            $table->string('uuid')->nullable();
            $table->string('transaccionTNS')->nullable();
            $table->string('hash')->nullable();
            $table->double('realValue', 11, 2)->nullable();
            $table->double('receipt_value', 11, 2)->nullable();
            $table->text('observation')->nullable();
            $table->enum('ispayment', array('N', 'Y', 'P'))->default('N');
            $table->enum('approved', array('N', 'A', 'R', 'P'))->default('N');
            $table->date('realdate');
            $table->string('voucher')->nullable();
            $table->integer('payment_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('verified_by')->nullable();
            $table->timestamp('payment_at')->nullable();
            $table->timestamps();
            $table->foreign('idyear')
                ->references('idyear')
                ->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idpaymenttype')
                ->references('idpaymenttype')
                ->on('paymenttypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idpackage')
                ->references('idpackage')
                ->on('packages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idbank')
                ->references('idbank')
                ->on('banks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idfamily')
                ->references('idfamily')
                ->on('families')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::drop('payments');
    }

}
