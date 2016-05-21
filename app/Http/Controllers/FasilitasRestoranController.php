<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use App\Restoran;
use App\Menu;
use App\FasilitasRestoran;
use App\JenisMasakan;
use App\WaktuOperasional;
use Session;
use Validator;

class FasilitasRestoranController extends Controller
{
    //
    public function editFasilitas(Request $request) {
       if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin', '=', $user)->get();
		$fasilitas_restorans = FasilitasRestoran::where('id_restoran', '=', $restoran[0]->id)->get();
		return view('edit-fasilitas')->with('restoran', $restoran[0])->with('fasilitas_restorans', $fasilitas_restorans)->with('user', $user);
    }

    public function addFasilitas(Request $request){
    	$validator = Validator::make($request->all(), [
        'fasilitas' => 'required|max:100',
    	]);

	    if ($validator->fails()) {
	        return redirect('/editFasilitasRestoran')
	            ->withInput()
	            ->withErrors($validator);
	    }
	    $user = Session::get('user');
        $restoran = Restoran::where('admin',Session::get('user')->email)->first();
	    $nama = Input::get('fasilitas');
	    $fasilitas = new FasilitasRestoran;
    	$fasilitas->nama_fasilitas = $nama;
    	$fasilitas->id_restoran = $restoran->id;
    	$fasilitas->save();
	    return Redirect::to('editFasilitasRestoran');
    }

    public function delete(Request $request){
    	FasilitasRestoran::where('id_restoran', '=', $id)->where('nama_fasilitas', '=', $nama)->delete();
    	return redirect('/editFasilitasRestoran');
    }
}
