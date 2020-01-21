<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('titlename_id')->nullable();
            $table->string('owner')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('province')->nullable();
            $table->unsignedBigInteger('district')->nullable();
            $table->unsignedBigInteger('subdistrict')->nullable();
            $table->string('tel')->nullable();
            $table->string('place')->nullable()->default('ไม่มีสถานที่เก็บตัวอย่าง');

            $table->foreign('titlename_id')->references('id')->on('titlenames');
            $table->foreign('province')->references('id')->on('provinces');
            $table->foreign('district')->references('id')->on('districts');
            $table->foreign('subdistrict')->references('id')->on('subdistricts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
