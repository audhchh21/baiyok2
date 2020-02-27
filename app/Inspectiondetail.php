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

    public function inspection()
    {
        return $this->belongsTo('App\Inspection', 'inspection_id');
    }

    //
    public function foodsample()
    {
        return $this->belongsTo('App\Foodsample', 'foodsample_id');
    }

    //
    public function foodsamplesource()
    {
        return $this->belongsTo('App\Foodsamplesource', 'foodsamplesource_id');
    }

    //
    public function foodtestkit()
    {
        return $this->belongsTo('App\Foodtestkit', 'foodtestkit_id');
    }
}
