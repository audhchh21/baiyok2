<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $table = 'plans';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'createby_user_id',
        'to_user_id',
        'shop_id',
        'plan_start',
        'plan_end',
        'status'
    ];
}
