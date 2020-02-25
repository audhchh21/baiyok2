<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('createby_user_id')->nullable();
            $table->unsignedInteger('to_user_id')->nullable();
            $table->unsignedInteger('shop_id')->nullable();
            $table->dateTime('plan_start')->nullable();
            $table->dateTime('plan_end')->nullable();
            $table->string('status', 5)->default('0');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('createby_user_id')->references('id')->on('users');
            $table->foreign('to_user_id')->references('id')->on('users');
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
