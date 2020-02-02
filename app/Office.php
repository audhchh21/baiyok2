<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    //
    protected $table = 'offices';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'name',
        'address',
        'subdistrict',
        'district',
        'province'
    ];

    public $timestamps = false;

    // Fullname Address
    public function getFulladdressAttribute()
    {
        return $this->address.' ตำบล'.$this->subdistricts->name.' อำเภอ'.$this->districts->name.' จังหวัด'.$this->provinces->name.' '.$this->subdistricts->zip_code;
    }

    //
    public function users()
    {
        return $this->hasMany('App\User');
    }

    //
    public function provinces()
    {
        return $this->belongsTo('App\Province', 'province');
    }

    //
    public function districts()
    {
        return $this->belongsTo('App\District', 'district');
    }

    //
    public function subdistricts()
    {
        return $this->belongsTo('App\Subdistrict', 'subdistrict');
    }
}
