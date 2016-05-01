<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    //
    protected $table = "pesanan";
 	protected $primaryKey = 'id_pesanan';
    public $timestamps = false;

	public function menu()
    {
        return $this->hasOne('Menu');
    }

    public function user()
    {
        return $this->hasOne('User');
    }
}
