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
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
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

	public function show($id)
	{
		$promo = Promo::find($id);
		$resto = Restoran::find($promo->id_restoran);
		$promo->resto = $resto->nama;
		return view('view-promo', compact('promo'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		if(session()->has('user')) {
			$user = session()->get('user')->email;
			$review = new Review;

			//$review->id = DB::table('reviews')->insertGetId(['email' => $user, 'id_menu' => $id, 'isi_review' => Input::get('isi'), 'rate' => Input::get('rate'), 'status' => 0]);
			// code by rama
			// user akan mendapatkan poin 5 untuk sebuah review di setiap menu
			$isireview = DB::table('reviews')->select('email')->where('id_menu',$id)->first();
			
			if(empty ($isireview) && $status = 1) {
				$statusrev = DB::table('reviews')->select('status')->where([['email',$user],['id_menu',$id]]);
				if($statusrev = 1){
					$userpoin = DB::table('users')->select('total_point')->where('email', $user)->first();
		            $poinuser = $userpoin->total_point;
		            $poin = $poinuser + 5;

		            DB::table('users')->where('email', $user)->update(['total_point' => $poin]);		
				}
			}
			// end of code

			$review->id = DB::table('reviews')->insertGetId(['email' => $user, 'id_menu' => $id, 'isi_review' => Input::get('isi'), 'rate' => Input::get('rate'), 'status' => 0]);
		}
		return Redirect::to('review/'.$id);
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
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
