<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapofficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapoffices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('map_office');
            $table->unsignedInteger('map_inspectiondetail');

            $table->foreign('map_office')->references('id')->on('offices');
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
        Schema::dropIfExists('mapoffices');
    }
}
