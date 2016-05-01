<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

	//
	protected $table = "review";
    protected $primaryKey = 'id';
    public $incrementing = false;
	
	public function user()
    {
        return $this->hasOne('User');
    }

    public function menu()
    {
        return $this->hasOne('Menu');
    }


}
