<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapoffice extends Model
{
    //
    protected $table = 'mapoffices';
    protected $primaryKey = 'id';
    protected $fillable = [
        'map_office',
        'map_inspectiondetail',
    ];
    public $timestamps = false;

    public function office(){
        return $this->belongsTo('App\Office', 'map_office');
    }

    public function inspectiondetail()
    {
        return $this->belongsTo('App\inspectiondetail', 'map_inspectiondetail');
    }
}
