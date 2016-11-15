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
            $table->string('email')->unique();
            $table->string('password');

            $table->string('username')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();;
            $table->string('google')->nullable();

            $table->integer('points')->default(0);
            $table->integer('credit')->default(0);
            $table->string('picture')->nullable();
            $table->enum('gender', ['unspecified', 'male', 'female'])->default('unspecified');
            $table->date('birth')->nullable();

            $table->integer('location_id')->nullable();
            $table->integer('referrer_id')->nullable();

            $table->timestamps();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
