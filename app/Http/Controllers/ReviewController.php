<?php 

namespace App\Http\Controllers;

use DB;

use App\Menu;
use App\Restoran;
use App\Review;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class ReviewController extends Controller {
	
	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function show($id)
	{
		//id yang masuk adalah id menu
		$review = Review::where([['id_menu', '=', $id],['status','=','1']])->get();;
		$menu = Menu::find($id);
		$restoran = Restoran::find($menu->id_restoran);
		// for ($i = 0; $i < count($review); $i++) {
		// 	$user = User::find($review->email);
		// 	$review[$i]->user = $user->nama_lengkap;
		// }
		return view('review', compact('review', 'menu', 'restoran'));
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
			$revTime = Carbon::now();
			
			if(empty ($isireview) && $status = 1) {
				$statusrev = DB::table('reviews')->select('status')->where([['email',$user],['id_menu',$id]]);
				if($statusrev = 1){
					$userpoin = DB::table('users')->select('total_point')->where('email', $user)->first();
		            $poinuser = $userpoin->total_point;
		            $poin = $poinuser + 5;

		            DB::table('point_history')->where('email', $user)->insert(['email' => $user, 'id_point' => 'PFC', 'waktu' => $revTime]);
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
