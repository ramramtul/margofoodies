<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Restoran;
use App\Menu;
use App\Promo;
use App\Pesanan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

use Session;

class HomeController extends Controller
{
	/**
	 * @author Karunia
	 * Mengirim daftar promo ke homepage
	 */
    public function home()
	{
		$promo = Promo::orderBy('tgl_berlaku_awal', 'asc')->get();
		$firstpromo = $promo[0];
		unset($promo[0]);
		return view('home', compact('firstpromo','promo'));
	}

	public function calculateFood(Request $request)
	{

		if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$deletedRows = Pesanan::where('id_user', $user)->delete();
		$request->session()->forget('resto');
		$request->session()->forget('jmlOrang');
		$request->session()->forget('menus');
		$request->session()->forget('orang');
		$restoran = Input::get('restoran');
		$jmlOrang =Input::get('orang');
		if($restoran===null){
            return Redirect::to('/home');
        } else { 
		$resto = Restoran::find($restoran);
		$menus = Menu::where('id_restoran', '=', $restoran)->lists('nama', 'id');
		$data = array(
                'resto'      => $resto,
                'jmlOrang'     => $jmlOrang,
                'menus'  => $menus,
                'orang' => 1
            );
		Session::put($data);
		$affectedRows = Pesanan::where('id_user', '=', $user)->delete();
		return Redirect::to('/calculateFood/1');
	}
	}
}
