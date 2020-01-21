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
        'owner',
        'address',
        'subdistrict',
        'district',
        'province',
        'zipcode',
        'tel',
        'place'
    ];
}
