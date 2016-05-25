<?php namespace App\Http\Controllers;

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

class RestoranController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function showList()
	{
		//
		$restoran = Restoran::orderBy('nama', 'asc')->paginate(6);
		return view('view-restoran-all')->with('restoran', $restoran);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$restoran = Restoran::find($id);
		$menus = Menu::where('id_restoran', '=', $id)->get();
		$fasilitas_restorans = FasilitasRestoran::where('id_restoran', '=', $id)->get();
		$jenis_masakans = JenisMasakan::where('id_restoran', '=', $id)->get();
		$waktu_operasionals = WaktuOperasional::where('id_restoran', '=', $id)->orderByRaw("FIELD(hari , 'Owner', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu') ASC")->get();
		$hari = date("l");
		if ($hari == "Sunday") $hari = "Minggu";
		else if ($hari == "Monday") $hari = "Senin";
		else if ($hari == "Tuesday") $hari = "Selasa";
		else if ($hari == "Wednesday") $hari = "Rabu";
		else if ($hari == "Thursday") $hari = "Kamis";
		else if ($hari == "Friday") $hari = "Jumat";
		else if ($hari == "Saturday") $hari = "Sabtu";
		$hari_ini = WaktuOperasional::where('id_restoran', '=', $id)->where('hari', '=', $hari)->get();
		$userku = session()->get('user');
		if ($restoran != null){
		return view('view-restoran')->with('restoran',$restoran)-> with('menus',$menus)-> with('fasilitas_restorans',$fasilitas_restorans) -> with ('jenis_masakans',$jenis_masakans)-> with('waktu_operasionals',$waktu_operasionals)->with('hari_ini', $hari_ini[0])->with('userku', $userku);
		} else {
			return view('error-page');
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit(Request $request)
	{
		if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin', '=', $user)->get();
		$menus = Menu::where('id_restoran', '=', $restoran[0]->id)->get();
		return view('edit-restoran')->with('restoran', $restoran[0])->with('menus', $menus)->with('user', $user);

	}

	public function view(Request $request)
	{
		if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin', '=', $user)->get();
		$id = $restoran[0]->id;
		$menus = Menu::where('id_restoran', '=', $id)->get();
		$fasilitas_restorans = FasilitasRestoran::where('id_restoran', '=', $id)->get();
		$jenis_masakans = JenisMasakan::where('id_restoran', '=', $id)->get();
		$waktu_operasionals = WaktuOperasional::where('id_restoran', '=', $id)->orderByRaw("FIELD(hari , 'Owner', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu') ASC")->get();
		$hari = date("l");
		if ($hari == "Sunday") $hari = "Minggu";
		else if ($hari == "Monday") $hari = "Senin";
		else if ($hari == "Tuesday") $hari = "Selasa";
		else if ($hari == "Wednesday") $hari = "Rabu";
		else if ($hari == "Thursday") $hari = "Kamis";
		else if ($hari == "Friday") $hari = "Jumat";
		else if ($hari == "Saturday") $hari = "Sabtu";
		$hari_ini = WaktuOperasional::where('id_restoran', '=', $id)->where('hari', '=', $hari)->get();
		return view('profile-restoran')->with('restoran', $restoran[0])->with('menus', $menus)->with('user', $user)-> with('fasilitas_restorans',$fasilitas_restorans) -> with ('jenis_masakans',$jenis_masakans)-> with('waktu_operasionals',$waktu_operasionals)->with('hari_ini', $hari_ini[0]);;

	}

	public function fotoResto(Request $request){
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin', '=', $user)->get();
		// getting all of the post data
		  $file = array('image' => Input::file('image'));
		  // setting up rules
		  $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
		  // doing the validation, passing post data, rules and the messages
		  $validator = Validator::make($file, $rules);
		  if ($validator->fails()) {
		    // send back to the page with the input data and errors
		    return Redirect::to('editRestoran')->withInput()->withErrors($validator);
		  }
		  else {
		    // checking file is valid.
		    if (Input::file('image')->isValid()) {
		      $destinationPath = 'uploads'; // upload path
		      $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
		      $fileName = "r".$restoran[0]->id.'.'."png"; // renameing image
		      Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      Session::flash('success', 'Upload successfully'); 
		      Restoran::where('id',$restoran[0]->id)->update(['id_photo' => $fileName]);
		      return Redirect::to('editRestoran');
		    }
		    else {
		      // sending back with error message.
		      Session::flash('error', 'uploaded file is not valid');
		      return Redirect::to('editRestoran');
		    }
		  }
	}

	public function editMenu(Request $request){
		if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin', '=', $user)->get();
		$menus = Menu::where('id_restoran', '=', $restoran[0]->id)->orderBy('nama', 'ASC')->paginate(10);
		$page = $menus->currentPage();
		return view('edit-menu-restoran')->with('restoran', $restoran[0])->with('menus', $menus)->with('page', $page)->with('user', $user);

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function confirmEdit(Request $request) {
        $this->validate($request, [
            'nama' => 'min:3|max:255',
            'telepon' => 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'tax' => 'numeric|min:0|max:100',
            'desc' => '',
            'lokasi' => '',
            'currPass' => 'required'
        ]);
        $user = Session::get('user');
        $restoran = Restoran::where('admin',Session::get('user')->email)->first();
        $currPass = Input::get('currPass');
        $nama = Input::get('nama', $restoran->nama_lengkap);
        $telepon = Input::get('telepon', $restoran->no_telepon);
        $tax = Input::get('tax', $restoran->tax);
        $lokasi = Input::get('lokasi', $restoran->lokasi);
        $desc = Input::get('desc', $restoran->deskripsi);

        if ($currPass == $user->password) {
            if (Restoran::where('id',$restoran->id)->update(['nama' => $nama, 'lokasi' => $lokasi, 'no_telepon' => $telepon,'tax' => $tax , 'deskripsi' => $desc])) {
                return Redirect::to('profileRestoran');
            } else {
                return Redirect::to('editRestoran')->with('dbErr','Error saat menyimpan ke database')->withInput();
            }       
        } else {
            return Redirect::to('editRestoran')->with('passErr','Password Salah!')->withInput();
        }
    }
}
