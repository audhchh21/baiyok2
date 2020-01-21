<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodtestkit extends Model
{
    //
    protected $table = 'foodtestkits';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'name'
    ];

    //
    public $timestamps = false;
}
