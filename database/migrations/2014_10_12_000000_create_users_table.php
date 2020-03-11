<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('login')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('balance')->default(0);
            $table->bigInteger('referBy')->unsigned()->nullable();
            $table->bigInteger('accountBy')->unsigned()->nullable();


            $table->timestamps();
            $table->softDeletes();

            $table->foreign('referBy')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('accountBy')->references('id')->on('users')->onDelete('cascade');
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
