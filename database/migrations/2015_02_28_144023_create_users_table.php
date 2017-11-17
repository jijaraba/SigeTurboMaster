<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('iduser');
            $table->integer('idcategory')->unsigned();
            $table->integer('idstatus')->unsigned();
            $table->integer('idmaritalstatus')->unsigned();
            $table->integer('idreligion')->unsigned();
            $table->integer('idethnicgroup')->unsigned();
            $table->integer('idgender')->unsigned();
            $table->integer('idtown')->unsigned();
            $table->integer('idstratus')->unsigned();
            $table->string('username',26)->unique();
            $table->string('email',128)->unique();
            $table->string('password');
            $table->string('firstname',50);
            $table->string('lastname',50);
            $table->date('birth')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('address',255)->nullable();
            $table->string('email_personal',255)->nullable();
            $table->string('photo',255)->nullable()->default('sigeturbo.jpg');
            $table->string('role',255)->default('Student');
            $table->string('role_selected',45)->nullable();
            $table->integer('points')->default(100);
            $table->boolean('email_confirmed')->default(0);
            $table->integer('email_passcode')->nullable();
            $table->boolean('celular_confirmed')->default(0);
            $table->integer('celular_passcode')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->string('api_token',60)->unique();
            $table->timestamp('last_session')->nullable();
            $table->integer('welcome_container')->default(0);
            $table->integer('first_login')->default(0);
            $table->rememberToken();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('idcategory')
                ->references('idcategory')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idstatus')
                ->references('idstatus')
                ->on('statuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idmaritalstatus')
                ->references('idmaritalstatus')
                ->on('maritalstatuses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idreligion')
                ->references('idreligion')
                ->on('religions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idethnicgroup')
                ->references('idethnicgroup')
                ->on('ethnicgroups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idgender')
                ->references('idgender')
                ->on('genders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idtown')
                ->references('idtown')
                ->on('towns')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('idstratus')
                ->references('idstratus')
                ->on('stratuses')
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
        Schema::dropIfExists('users');
    }
}
