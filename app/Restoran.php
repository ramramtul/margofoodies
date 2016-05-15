<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model {

	//
    protected $table = "restorans";
    protected $primaryKey = 'id';
    public $incrementing = false; 
	public function menu()
    {
        return $this->hasMany('Menu');
    }

    public function jenisMasakan()
    {
        return $this->hasMany('JenisMasakan');
    }

    public function fasilitasRestoran()
    {
        return $this->hasMany('FasilitasRestoran');
    }

    public function waktuOperasional()
    {
        return $this->hasMany('WaktuOperasional');
    }

     public function user()
    {
        return $this->hasOne('User');
    }


}
