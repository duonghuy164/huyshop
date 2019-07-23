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
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password')->nullable();//login facebook
            $table->string('social_id')->nullable();// login facebook
            $table->string('avatar')->nullable();// login facebook
            $table->integer('rule')->default(0);// phan quen 0 la khach hang 1 la admin
            $table ->integer('status')->delete(0);// tai khoan chua kich hoat 0 da kich hoat 1
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
