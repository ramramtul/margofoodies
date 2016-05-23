<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model {

	//
	protected $table = "promo";
    protected $primaryKey = 'id';
    public $incrementing = false;
	
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }

}
