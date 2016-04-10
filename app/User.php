<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'update_at',
        'created_at'
    ];

    protected $hidden = [
        'password',
    ];
}