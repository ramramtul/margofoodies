<?php 

namespace App\Http\Controllers;

use DB;

use App\Restoran;
use App\Promo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class PromoController extends Controller {
	
	/**
	 * @author Karunia
	 * Menampilkan semua promo yang ada
	 */
	public function showAll()
	{
		$promo = Promo::orderBy('tgl_berlaku_awal', 'asc')->get();
		foreach ($promo as $pro) {
			$resto = Restoran::find($pro->id_restoran);
			$pro->resto = $resto->nama;
		}
		return view('promo', compact('promo'));
	}

	/**
	 * @author Karunia
	 * Menampilkan promo tertentu
	 */
	public function show($id)
	{
		$promo = Promo::find($id);
		$resto = Restoran::find($promo->id_restoran);
		$promo->resto = $resto->nama;
		return view('view-promo', compact('promo'));
	}

}
