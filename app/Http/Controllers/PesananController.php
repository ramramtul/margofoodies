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
		$user = $request->session()->get('email');
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
		$user = $request->session()->get('email');
		$affectedRows = Pesanan::where('id_user', '=', $user)->delete();
		return Redirect::to('/');
	}

	public function calculateId(Request $request, $or)
	{
		
		return view ('desc-calculator')->with('or', $or);
	}


	public function pesan(Request $request, $orang)
	{

		$user = $request->session()->get('email');
		$or = session()->get('orang');
		if($user == null){
			return view('home');
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
		$user = session()->get('email');
		$orang = session()->get('orang');
		$pesanan = Pesanan::find(Input::get('pesanan'));
		if($user === $pesanan->id_user) {
   		 	$pesanan->delete();
   		}

   		return Redirect::to('/calculateFood/'.$orang.'');
   		

    	//return view ('food-calculator');
	}
	

}
