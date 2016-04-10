<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FasilitasRestoran extends Model {

	//
	protected $table = "fasilitas_restorans";
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }


}
