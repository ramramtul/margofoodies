<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisMasakan extends Model {

	//
	protected $table = "jenis_masakans";
	protected $primaryKey = array('id_restoran', 'jenis_masakan');
	public $incrementing = false;
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }

}
