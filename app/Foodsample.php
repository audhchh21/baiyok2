<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foodsample extends Model
{
    //
    protected $table = 'foodsamples';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'name',
        'category'
    ];

    //
    public $timestamps = false;
}
