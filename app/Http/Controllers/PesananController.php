<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Session;


class PesananController extends Controller
{
   var $count = 0;
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function showList()
	{
		//
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//
		$user = $request->session()->get('user')->email;
		$id = $request->session()->get('orang');
		$menu = Input::get('menu');
		$pesanan = new Pesanan;
        $pesanan->id_user = $user;
        $pesanan->id_menu = $menu;
        $pesanan->id_orang = $id;
        $pesanan->save();
        return Redirect::to('/calculateFood/'.$id.'');


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	public function reset(Request $request)
	{
		$user = session()->get('user')->email;
		$deletedRows = Pesanan::where('id_user', $user)->delete();
		$request->session()->forget('resto');
		$request->session()->forget('jmlOrang');
		$request->session()->forget('menus');
		$request->session()->forget('resto');
   		return Redirect::to('/home');
	}

	public function calculateId(Request $request, $or)
	{
		
		return view ('desc-calculator')->with('or', $or);
	}


	public function pesan(Request $request, $orang)
	{

		$user = $request->session()->get('user')->email;
		$or = session()->get('orang');
		if($user == null){
			return Redirect::to('/home');
		}
		if (!(Session::has('jmlOrang')))
		{
		    return Redirect::to('/home');
		}
		$jml = session()->get('jmlOrang') + 1;
		if($jml >= $orang){
			Session::set('orang', $orang);
			return view ('food-calculator');
		} else {
			return Redirect::to('/calculateFood/'.$or.'');
		}
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		$user = session()->get('user')->email;
		$orang = session()->get('orang');
		$pesanan = Pesanan::find(Input::get('pesanan'));
		if($user === $pesanan->id_user) {
   		 	$pesanan->delete();
   		}

   		return Redirect::to('/calculateFood/'.$orang.'');
   		

    	//return view ('food-calculator');
	}
	

}
