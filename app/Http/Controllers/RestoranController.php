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
		if ($restoran != null){
		return view('view-restoran')->with('restoran',$restoran)-> with('menus',$menus)-> with('fasilitas_restorans',$fasilitas_restorans) -> with ('jenis_masakans',$jenis_masakans)-> with('waktu_operasionals',$waktu_operasionals)->with('hari_ini', $hari_ini[0]);
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

	public function fotoMenu(Request $request){
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
		      $fileName = $restoran[0]->nama.'.'."png"; // renameing image
		      Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      Session::flash('success', 'Upload successfully'); 
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
		$menus = Menu::where('id_restoran', '=', $restoran[0]->id)->paginate(10);
		return view('edit-menu')->with('restoran', $restoran[0])->with('menus', $menus)->with('user', $user);

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

    public function editWaktu(Request $request) {
        if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin', '=', $user)->get();
		$waktu_operasionals = WaktuOperasional::where('id_restoran', '=', $restoran[0]->id)->orderByRaw("FIELD(hari , 'Owner', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu') ASC")->get();
		return view('edit-waktu')->with('restoran', $restoran[0])-> with('waktu_operasionals',$waktu_operasionals)->with('user', $user);
    }

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

    public function confirmEditWaktu(Request $request) {
    	$currPass = Input::get('currPass');
        $bSenin = Input::get('bSenin');
        $bSelasa = Input::get('bSelasa');
        $bRabu = Input::get('bRabu');
        $bKamis = Input::get('bKamis');
        $bJumat = Input::get('bJumat');
        $bSabtu = Input::get('bSabtu');
        $bMinggu = Input::get('bMinggu');
        $tSenin = Input::get('tSenin');
        $tSelasa = Input::get('tSelasa');
        $tRabu = Input::get('tRabu');
        $tKamis = Input::get('tKamis');
        $tJumat = Input::get('tJumat');
        $tSabtu = Input::get('tSabtu');
        $tMinggu = Input::get('tMinggu');
    	if(($bSenin == "" && $tSenin != "") || ($bSenin != "" && $tSenin == "")) {
        		return Redirect::to('editWaktuOperasional')->with('SeninErr','Harus diisi keduanya')->withInput();
        }
        if(($bSelasa == "" && $tSelasa != "") || ($bSelasa != "" && $tSelasa == "")) {
        		return Redirect::to('editWaktuOperasional')->with('SelasaErr','Harus diisi keduanya')->withInput();
        } 
        if(($bRabu == "" && $tRabu != "") || ($bRabu != "" && $tRabu == "")) {
        		return Redirect::to('editWaktuOperasional')->with('RabuErr','Harus diisi keduanya')->withInput();
        }
        if(($bKamis == "" && $tKamis != "") || ($bKamis != "" && $tKamis== "")) {
        		return Redirect::to('editWaktuOperasional')->with('KamisErr','Harus diisi keduanya')->withInput();
        }
        if(($bJumat == "" && $tJumat != "") || ($bJumat != "" && $tJumat == "")) {
        		return Redirect::to('editWaktuOperasional')->with('JumatErr','Harus diisi keduanya')->withInput();
        }
        if(($bSabtu == "" && $tSabtu != "") || ($bSabtu != "" && $tSabtu == "")) {
        		return Redirect::to('editWaktuOperasional')->with('SabtuErr','Harus diisi keduanya')->withInput();
        }
        if(($bMinggu == "" && $tMinggu != "") || ($bMinggu != "" && $tMinggu == "")) {
        		return Redirect::to('editWaktuOperasional')->with('MingguErr','Harus diisi keduanya')->withInput();
        }

        $validator = Validator::make($request->all(), [
            'tSenin' => 'date_format:H:i:s',
            'tSelasa' => 'date_format:H:i:s',
            'tRabu' => 'date_format:H:i:s',
            'tKamis' => 'date_format:H:i:s',
            'tJumat' => 'date_format:H:i:s',
            'tSabtu' => 'date_format:H:i:s',
            'tMinggu' => 'date_format:H:i:s',
            'bSenin' => 'date_format:H:i:s',
            'bSelasa' => 'date_format:H:i:s',
            'bRabu' => 'date_format:H:i:s',
            'bKamis' => 'date_format:H:i:s',
            'bJumat' => 'date_format:H:i:s',
            'bSabtu' => 'date_format:H:i:s',
            'bMinggu' => 'date_format:H:i:s',
            'currPass' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('editWaktuOperasional')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = Session::get('user');
        $restoran = Restoran::where('admin',Session::get('user')->email)->first();
        $waktu = WaktuOperasional::where('id_restoran', '=', $restoran->id)->orderByRaw("FIELD(hari , 'Owner', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu') ASC")->get();

        if ($currPass == $user->password) {
        	$status = true;
        	if($tSenin < $bSenin ) {
        		return Redirect::to('editWaktuOperasional')->with('SeninErr','Masukkan waktu yang sesuai')->withInput();
        	}
        	if($bSenin == "" && $tSenin == ""){
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Senin')->update(['waktu_buka' => null, 'waktu_tutup' => null]);	
        	} else if($waktu[0]->waktu_buka != $bSenin || $waktu[0]->waktu_tutup != $tSenin) {
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Senin')->update(['waktu_buka' => $bSenin, 'waktu_tutup' => $tSenin]);
			}

			if($tSelasa < $bSelasa ) {
        		return Redirect::to('editWaktuOperasional')->with('SelasaErr','Masukkan waktu yang sesuai')->withInput();
        	}
        	if($bSelasa == "" && $tSelasa == ""){
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Selasa')->update(['waktu_buka' => null, 'waktu_tutup' => null]);	
        	} else if($waktu[1]->waktu_buka != $bSelasa || $waktu[1]->waktu_tutup != $tSelasa) {
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Selasa')->update(['waktu_buka' => $bSelasa, 'waktu_tutup' => $Selasa]);
			}

			if($tRabu < $bRabu ) {
        		return Redirect::to('editWaktuOperasional')->with('RabuErr','Masukkan waktu yang sesuai')->withInput();
        	}
			if($bRabu == "" && $tRabu == ""){
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Rabu')->update(['waktu_buka' => null, 'waktu_tutup' => null]);	
        	} else if($waktu[2]->waktu_buka != $bRabu || $waktu[2]->waktu_tutup != $tRabu) {
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Rabu')->update(['waktu_buka' => $bRabu, 'waktu_tutup' => $tRabu]);
			}

			if($tKamis < $bKamis ) {
        		return Redirect::to('editWaktuOperasional')->with('KamisErr','Masukkan waktu yang sesuai')->withInput();
        	}
			if($bKamis == "" && $tKamis == ""){
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Kamis')->update(['waktu_buka' => null, 'waktu_tutup' => null]);	
        	} else if($waktu[3]->waktu_buka != $bKamis || $waktu[3]->waktu_tutup != $tKamis) {
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Kamis')->update(['waktu_buka' => $bKamis, 'waktu_tutup' => $tKamis]);
			}

			if($tJumat < $bJumat ) {
        		return Redirect::to('editWaktuOperasional')->with('JumatErr','Masukkan waktu yang sesuai')->withInput();
        	}
			if($bJumat == "" && $tJumat == ""){
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Jumat')->update(['waktu_buka' => null, 'waktu_tutup' => null]);	
        	} else if($waktu[4]->waktu_buka != $bJumat || $waktu[4]->waktu_tutup != $tJumat) {
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Jumat')->update(['waktu_buka' => $bJumat, 'waktu_tutup' => $tJumat]);
			}

			if($tSabtu < $bSabtu ) {
        		return Redirect::to('editWaktuOperasional')->with('SabtuErr','Masukkan waktu yang sesuai')->withInput();
        	}
			if($bSabtu == "" && $tSabtu == ""){
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Sabtu')->update(['waktu_buka' => null, 'waktu_tutup' => null]);	
        	} else if($waktu[5]->waktu_buka != $bSabtu || $waktu[5]->waktu_tutup != $tSabtu) {
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Sabtu')->update(['waktu_buka' => $bSabtu, 'waktu_tutup' => $tSabtu]);
			}

			if($tMinggu < $bMinggu ) {
        		return Redirect::to('editWaktuOperasional')->with('MinggguErr','Masukkan waktu yang sesuai')->withInput();
        	}
			if($bMinggu == "" && $tMinggu == ""){
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Minggu')->update(['waktu_buka' => null, 'waktu_tutup' => null]);	
        	} else if($waktu[6]->waktu_buka != $bMinggu || $waktu[6]->waktu_tutup != $tMinggu ) {
        		$status = $status && WaktuOperasional::where('id_restoran', '=', $restoran->id)->where('hari', '=', 'Minggu')->update(['waktu_buka' => $bMinggu, 'waktu_tutup' => $tMinggu]);
			}
        	
   
            if ($status) {
                return Redirect::to('profileRestoran');
            } else {
                return Redirect::to('editWaktuOperasional')->with('dbErr','Error saat menyimpan ke database')->withInput();
            }       
        } else {
            return Redirect::to('editWaktuOperasional')->with('passErr','Password Salah!')->withInput();
        }
			
    }

}
