<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    protected $table = 'districts';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'name',
        'province_id'
    ];

    //
    public $timestamps = false;
}
