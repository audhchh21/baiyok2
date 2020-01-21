<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodsamplesource extends Model
{
    //
    protected $table = 'foodsamplesources';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
