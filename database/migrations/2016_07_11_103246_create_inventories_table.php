<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idinventory');
            $table->integer('idinventorytype')->unsigned();
            $table->integer('idasset')->unsigned();
            $table->integer('idubication')->unsigned();
            $table->integer('idquality')->unsigned();
            $table->integer('iduser')->unsigned();
            $table->text('observation')->nullable();
            $table->integer('verified_by')->nullable();
            $table->timestamps();
            $table->foreign('idinventorytype')
                ->references('idinventorytype')
                ->on('inventorytypes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idasset')
                ->references('idasset')
                ->on('assets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idubication')
                ->references('idubication')
                ->on('ubications')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idquality')
                ->references('idquality')
                ->on('qualities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unique(array('idinventorytype','idasset'),'inventories_verified_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inventories');
    }
}
