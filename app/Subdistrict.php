<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    //
    protected $table = 'subdistricts';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'name',
        'zip_code',
        'district_id'
    ];

    public $timestamps = false;

    //
    public function districts()
    {
        return $this->belongsTo('App\District', 'district_id');
    }
}
