<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titlename extends Model
{
    //
    protected $table = 'titlenames';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable= [
        'name'
    ];

    //
    public $timestamps = false;
}
