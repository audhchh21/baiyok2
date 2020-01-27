<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $table = 'shops';
    //
    protected $primaryKey = 'id';
    //
    protected $fillable = [
        'name',
        'titlename_id',
        'f_name',
        'l_name',
        'address',
        'subdistrict',
        'district',
        'province',
        'zipcode',
        'tel',
        'place'
    ];

    public $timestamps = false;

    // Fullname Address
    public function getFulladdressAttribute()
    {
        return $this->address.' '.$this->provinces->name.' '.$this->districts->name.' '.$this->subdistricts->name.' '.$this->subdistricts->zip_code;
    }

    // Fullname User
    public function getFullnameAttribute()
    {
        return $this->titlenames->name.''.$this->f_name.' '.$this->l_name;
    }

    //
    public function titlenames()
    {
        return $this->belongsTo('App\Titlename', 'titlename_id', 'id');
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
