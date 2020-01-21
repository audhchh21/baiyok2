<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
    protected $table = 'provinces';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
