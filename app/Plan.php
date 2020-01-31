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
        'user_id',
        'createby_user_id',
        'to_user_id',
        'shop_id',
        'plan_start',
        'plan_end',
        'status'
    ];

    // Fullname User
    public function getFulltimeAttribute()
    {
        return $this->plan_start.' ถึง '.$this->plan_end;
    }

    //
    public function by_user()
    {
        return $this->belongsTo('App\User', 'createby_user_id', 'id');
    }

    //
    public function to_user()
    {
        return $this->belongsTo('App\User', 'to_user_id', 'id');
    }

    //
    public function shops()
    {
        return $this->belongsTo('App\Shop', 'shop_id', 'id');
    }

    //
    public function inspection()
    {
        return $this->hasOne('App\Inspection', 'plan_id', 'id');
    }
}
