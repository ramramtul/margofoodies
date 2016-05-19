<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	//
	protected $table = "menus";
	protected $fillable =  ['nama', 'harga', 'kapasitas', 'id_restoran', 'jenis', 'id_photo', 'deskripsi', 'kategori', 'is_paket_tanpa_minum', 'is_paket_dgn_minum', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
	
	public function restoran()
    {
        return $this->hasOne('Restoran');
    }

}
