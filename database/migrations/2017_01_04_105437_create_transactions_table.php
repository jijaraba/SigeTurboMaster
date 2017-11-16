<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idtransaction');
            $table->integer('idpayment')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->integer('idvouchertype')->unsigned();
            $table->integer('idaccounttype')->unsigned();
            $table->integer('idtransactiontype')->unsigned();
            $table->integer('idcostcenter')->unsigned();
            $table->integer('document')->default(0);
            $table->integer('reference')->default(0);
            $table->double('value', 11, 2);
            $table->double('base', 11, 2);
            $table->string('transaction')->nullable();
            $table->integer('term');
            $table->date('date');
            $table->date('realdate');
            $table->integer('nit');
            $table->text('description')->nullable();
            $table->string('prefix')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idpayment')
                ->references('idpayment')
                ->on('payments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idvouchertype')
                ->references('idvouchertype')
                ->on('vouchertypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idaccounttype')
                ->references('idaccounttype')
                ->on('accounttypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idtransactiontype')
                ->references('idtransactiontype')
                ->on('transactiontypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idcostcenter')
                ->references('idcostcenter')
                ->on('costcenters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.*
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
