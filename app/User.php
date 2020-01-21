<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //
    protected $table = 'users';

    //
    protected $primaryKey = 'id';

    //
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

    //
    protected $hidden = [
        'password', 'remember_token',
    ];

    //
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
