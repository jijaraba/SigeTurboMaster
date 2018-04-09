<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountingentries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idaccountingentry');
            $table->integer('idreceipt')->unsigned();
            $table->integer('idaccounttype')->unsigned();
            $table->integer('idtransactiontype')->unsigned();
            $table->integer('reference')->default(0);
            $table->double('value', 11, 2);
            $table->double('base', 11, 2);
            $table->string('transaction')->nullable();
            $table->integer('term');
            $table->integer('nit');
            $table->text('description')->nullable();
            $table->string('prefix')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idreceipt')
                ->references('idreceipt')
                ->on('receipts')
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
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accountingentries');
    }
}
