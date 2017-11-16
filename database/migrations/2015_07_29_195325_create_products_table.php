<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idproduct');
            $table->integer('idproductcategory')->unsigned();
            $table->integer('code')->unique();
            $table->string('name');
            $table->decimal('vat', 2, 2);
            $table->string('unit');
            $table->timestamps();
            $table->foreign('idproductcategory')
                ->references('idproductcategory')
                ->on('productcategories')
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
        Schema::drop('products');
    }

}
