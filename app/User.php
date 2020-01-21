<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Table
    protected $table = 'users';

    // PrimaryKey
    protected $primaryKey = 'id';

    // fill structure
    protected $fillable = [
        'email',
        'password',
        'titlename_id',
        'f_name',
        'l_name',
        'phone',
        'office_id',
        'type',
        'status'
    ];

    // Hidden Password
    protected $hidden = [
        'password', 'remember_token',
    ];

    // email_verified_at
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Fullname User
    public function getFullnameAttribute()
    {
        return $this->titlenames->name.''.$this->f_name.' '.$this->l_name;
    }

    // Join Table Titlename
    public function titlenames()
    {
        return $this->belongsTo('App\Titlename', 'office_id', 'id');
    }

    // Join Table Office
    public function offices()
    {
        return $this->belongsTo('App\Office', 'office_id', 'id');
    }
}
