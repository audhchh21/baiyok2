<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    //
    protected $table = 'inspections';

    //
    protected $primaryKey = 'id';

    //
    protected $fillable = [
        'plan_id',
        'date',
        'status'
    ];

    //
    public function plan()
    {
        return $this->belongsTo('App\Plan', 'plan_id');
    }

    //
    public function inspectiondetails()
    {
        return $this->hasMany('App\Inspectiondetail', 'inspection_id');
    }
}
