<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    public $timestamps = false;

    protected $fillable = [
        'id_photo',
        'alamat'
    ];

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = $value;
    }
}