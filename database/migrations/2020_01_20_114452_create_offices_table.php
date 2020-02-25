<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->string('name', 150)->unique()->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('province')->nullable();
            $table->unsignedInteger('district')->nullable();
            $table->unsignedInteger('subdistrict')->nullable();

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
        Schema::dropIfExists('offices');
    }
}
