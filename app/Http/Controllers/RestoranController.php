<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Restoran;
use App\Menu;
use App\FasilitasRestoran;
use App\JenisMasakan;
use App\WaktuOperasional;

class RestoranController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
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
		
		return view('view-restoran')->with('restoran',$restoran)-> with('menus',$menus)-> with('fasilitas_restorans',$fasilitas_restorans) -> with ('jenis_masakans',$jenis_masakans)-> with('waktu_operasionals',$waktu_operasionals)->with('hari_ini', $hari_ini[0]);

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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

}
