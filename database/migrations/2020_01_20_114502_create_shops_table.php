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
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->unsignedInteger('titlename_id')->nullable();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('province')->nullable();
            $table->unsignedInteger('district')->nullable();
            $table->unsignedInteger('subdistrict')->nullable();
            $table->string('tel', 10)->nullable();
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
