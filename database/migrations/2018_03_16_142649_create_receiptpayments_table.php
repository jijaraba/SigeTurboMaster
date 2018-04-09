<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiptpayments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idreceiptpayment');
            $table->integer('idreceipt')->unsigned();
            $table->integer('idpayment')->unsigned();
            $table->double('value', 11, 2);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('receiptpayments');
    }
}
