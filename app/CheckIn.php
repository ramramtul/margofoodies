<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    //
    protected $table = 'check_in';
    public $timestamps = false;
    public $incrementing = false;
}
