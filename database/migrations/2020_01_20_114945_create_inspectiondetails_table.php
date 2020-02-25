<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectiondetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectiondetails', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->unsignedInteger('inspection_id')->nullable();
            $table->unsignedInteger('foodsample_id')->nullable();
            $table->unsignedInteger('foodsamplesource_id')->nullable();
            $table->unsignedInteger('foodtestkit_id')->nullable();
            $table->integer('inspection_result')->nullable();
            $table->string('actuation_after')->nullable()->default('ไม่มีหมายเหตุ');
            $table->string('inspection_image')->nullable()->default('no-image.png');
            $table->timestamps();

            $table->foreign('inspection_id')->references('id')->on('inspections')->onDelete('cascade');
            $table->foreign('foodsample_id')->references('id')->on('foodsamples');
            $table->foreign('foodsamplesource_id')->references('id')->on('foodsamplesources');
            $table->foreign('foodtestkit_id')->references('id')->on('foodtestkits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspectiondetails');
    }
}
