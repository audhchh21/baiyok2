<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapdistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapdistricts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('map_district');
            $table->unsignedInteger('map_inspectiondetail');

            $table->foreign('map_district')->references('id')->on('districts');
            $table->foreign('map_inspectiondetail')->references('id')->on('inspectiondetails');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapdistricts');
    }
}
