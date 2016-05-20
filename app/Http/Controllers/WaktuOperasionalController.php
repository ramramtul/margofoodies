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

class WaktuOperasionalController extends Controller
{
    //
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

        if (md5($currPass) == $user->password) {
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
