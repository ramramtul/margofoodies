<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class WaktuOperasional extends Model {
	//
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }
}