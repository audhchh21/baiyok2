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
}
