<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMasakan extends Model {

	//
	protected $table = "jenis_masakans";
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }

}
