<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspectiondetail extends Model
{
    //
    protected $table = 'inspectiondetails';
    //
    protected $primaryKey = 'id';
    //
    protected $fillable = [
        'inspection_id',
        'foodsample_id',
        'foodsamplesource_id',
        'foodtestkit_id',
        'inspection_result',
        'actuation_after',
        'inspection_image',
    ];
}
