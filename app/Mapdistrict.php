<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapdistrict extends Model
{
    //
    protected $table = 'mapdistricts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'map_district',
        'map_inspectiondetail',
    ];
    public $timestamps = false;

    public function district(){
        return $this->belongsTo('App\District', 'map_district');
    }

    public function inspectiondetail()
    {
        return $this->belongsTo('App\inspectiondetail', 'map_inspectiondetail');
    }
}
