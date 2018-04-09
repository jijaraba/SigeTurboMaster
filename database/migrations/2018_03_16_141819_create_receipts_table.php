<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idreceipt');
            $table->integer('idvouchertype')->unsigned();
            $table->integer('idcostcenter')->unsigned();
            $table->integer('document');
            $table->date('date');
            $table->date('realdate')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idvouchertype')
                ->references('idvouchertype')
                ->on('vouchertypes')
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
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
}
