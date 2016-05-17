<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FasilitasRestoran extends Model {

	//
	protected $table = "fasilitas_restorans";
	protected $primaryKey = array('id_restoran', 'nama_fasilitas');
	public $incrementing = false;
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }


}
