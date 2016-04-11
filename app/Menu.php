<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	//
	protected $table = "menus";
    protected $primaryKey = 'id';
    public $incrementing = false;
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }

}
