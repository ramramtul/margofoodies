<?php 

namespace App\Http\Controllers;

use DB;

use App\Menu;
use App\Restoran;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;


class MenuController extends Controller {

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
	 * @param  string  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$menu = Menu::find($id);
		return view('view-menu', compact('menu'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return Response
	 */
	public function showList($id)
	{
		//
		$restoran = Restoran::find($id);
		$menus = Menu::where('id_restoran', '=', $id)->paginate(5);
		//dd($menus);
		if ($restoran != null){
			return view('view-menus')->with('menus', $menus)->with('restoran', $restoran);
		} else {
			return view('error-page');
		}
	}

	public function search()
	{
		$syarat = Input::get('query');
		$temp = '%'.$syarat.'%';
		$menu = Menu::where('nama', 'like', $temp)->paginate(5);
		for ($i = 0; $i < count($menu); $i++) {
			$id = $menu[$i]->id_restoran;
			$resto = Restoran::find($id);
			$menu[$i]->resto = $resto->nama;
		}
		return view('view-search')->with('menu', $menu)->with('query', $syarat);
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

	/**
	 * Kombinasi makanan pada suatu restoran
	 *	
	 * @author Putra Muttaqin
	 * 
	 * @param  array of menu yang harganya di bawah budget dan porsi yang sesuai pada suatu restoran
	 * @return kombinasi menu pada suatu restoran
	 */
	public function kombinasi($i, $menus, $temp, $str, $result)
	{
		// M-Main dish, D-Drink, S-Side dish, C-Cemilan
		if (strpos($str, 'M') !== false && strpos($str, 'D') !== false && strpos($str, 'S') !== false && strpos($str, 'C') !== false) {
			array_push($result, array($temp));
			return $result;
		}
		if ($i == sizeof($menus) && strpos($str, 'M') !== false && strpos($str, 'D') !== false) {
			array_push($result, array($temp));
			return $result;
		}
		if ($i == sizeof($menus) && $str == 'C') {
			array_push($result, array($temp));
			return $result;
		}
		if ($i == sizeof($menus) && $str == 'D') {
			array_push($result, array($temp));
			return $result;
		}
		if ($i == sizeof($menus)){
			return $result;
		}
		echo $i." ".sizeof($menus)." ".$str."<br>";
		echo $menus[$i]->jenis." : ".$menus[$i]->nama_menu."<br>";
		var_dump($temp);
		echo "<br>------------------------------------------------------------------------------------<br>";
		if ($menus[$i]->jenis == "Makanan Utama") {
			if (strpos($str, 'M') !== false) {
				return $this->kombinasi($i+1, $menus, $temp, $str, $result);
			} else {
				$anotemp = $temp;
				$temp['M'] = $menus[$i];
				$result = $this->kombinasi($i+1, $menus, $temp, $str.'M', $result);
				$result = $this->kombinasi($i+1, $menus, $anotemp, $str, $result);
				return $result;
			}	
		} else if ($menus[$i]->jenis == "Minuman") {
			if (strpos($str, 'D') !== false) {
				return $this->kombinasi($i+1, $menus, $temp, $str, $result);
			} else {
				$anotemp = $temp;
				$temp['D'] = $menus[$i];
				$result = $this->kombinasi($i+1, $menus, $temp, $str.'D', $result);
				$result = $this->kombinasi($i+1, $menus, $anotemp, $str, $result);
				return $result;
			}
		} else if ($menus[$i]->jenis == "Makanan Pelengkap") {
			if (strpos($str, 'S') !== false) {
				return $this->kombinasi($i+1, $menus, $temp, $str, $result);
			} else {
				$anotemp = $temp;
				$temp['S'] = $menus[$i];
				$result = $this->kombinasi($i+1, $menus, $temp, $str.'S', $result);
				$result = $this->kombinasi($i+1, $menus, $anotemp, $str, $result);
				return $result;
			}
		} else if ($menus[$i]->jenis == "Cemilan") {
			if (strpos($str, 'C') !== false) {
				return $this->kombinasi($i+1, $menus, $temp, $str, $result);
			} else {
				$anotemp = $temp;
				$temp['C'] = $menus[$i];
				$result = $this->kombinasi($i+1, $menus, $temp, $str.'C', $result);
				$result = $this->kombinasi($i+1, $menus, $anotemp, $str, $result);
				return $result;				
			}
		}
	}

	/**
	 * menggabungkan hasil kombinasi menu pada sebuah restoran ke array kombinasi menu utama
	 *	
	 * @author Putra Muttaqin
	 * 
	 * @param  array of menu yang harganya di bawah budget dan porsi yang sesuai
	 * @return kombinasi menu
	 */
	public function merge_kombinasi($result, $menus, $porsi)
	{
		$i = 0;
		$result = [];
		while ($i < sizeof($menus)) {
			$j = 0;
			// var_dump($menus->$i)
			$id_resto = $menus[$i]->resto_id;
			$menu_resto = [];
			while ($i < sizeof($menus) && $menus[$i]->resto_id == $id_resto) {
				$menu_resto[$j] = $menus[$i];
				$i++;
				$j++;
			}
			$kombinasi_menu_resto = $this->kombinasi(0, $menu_resto, [], "", []);
			echo "Resto ".$id_resto."<br>";
			var_dump($kombinasi_menu_resto);
			echo "<br>=======================================================================================================================================<br><br><br><br><br><br><br><br>";
			$result = $this->merge_kombinasi($result,$kombinasi_menu_resto, $harga, $porsi);
		}
		return $result;
	}

	/**
	 * Kombinasi makanan
	 *	
	 * @author Putra Muttaqin
	 * 
	 * @param  array of menu yang harganya di bawah budget dan porsi yang sesuai
	 * @return kombinasi menu
	 */
	public function combination($budget, $porsi)
	{
		$i = 0;
		$result = [];
		$main= DB::table('menus')->join('restorans', 'menus.id_restoran', '=', 'restorans.id')->select(DB::raw('restorans.id as resto_id, restorans.nama as nama_resto, restorans.lokasi as lokasi, restorans.tax as tax, menus.nama as nama_menu, menus.harga as harga, menus.kapasitas as porsi, menus.jenis as jenis, menus.deskripsi as deskripsi, menus.id_photo as photo_menu, menus.rate as rate_menu, menus.jumlah_tested as jumlah_tested, menus.is_paket_tanpa_minum as tanpa_minuman'))->where([['harga','<=',$budget],['kapasitas','<=',$porsi],['jenis','=','Makanan Utama']])->orderBy('id_restoran')->orderBy('jenis')->get();
		$drinks= DB::table('menus')->join('restorans', 'menus.id_restoran', '=', 'restorans.id')->select(DB::raw('restorans.id as resto_id, restorans.nama as nama_resto, restorans.lokasi as lokasi, restorans.tax as tax, menus.nama as nama_menu, menus.harga as harga, menus.kapasitas as porsi, menus.jenis as jenis, menus.deskripsi as deskripsi, menus.id_photo as photo_menu, menus.rate as rate_menu, menus.jumlah_tested as jumlah_tested, menus.is_paket_tanpa_minum as tanpa_minuman'))->where([['harga','<=',$budget],['kapasitas','<=',$porsi],['jenis','=','Minuman']])->orderBy('id_restoran')->orderBy('jenis')->get();
		
		foreach ($main as $mainMenu) {
			foreach ($drinks as $drink) {
				$temp = array(
					'nama_menu' => $mainMenu->nama_menu." + ".$drink->nama_menu,
					'deskripsi' => $mainMenu->deskripsi,
					'jenis' 	=> $mainMenu->jenis." + ".$drink->jenis,
					'harga'		=> $mainMenu->harga + $drink->harga,
					'nama_resto'=> $mainMenu->nama_menu,
					'rate_menu'	=> $mainMenu->rate_menu,
					'jumlah_tested'=> $mainMenu->jumlah_tested
				);
				if ($temp['harga'] <= $budget) {
					array_push($result, $temp);
				}
			}
		}
		echo "hai ".$budget." ".$porsi."<br>";
		var_dump($result);
		return $result;
	}

	/**
	 * Memanggil view yang akan menampilkan kombinasi makanan
	 *	
	 * @author Putra Muttaqin
	 * 
	 * @return view dari kombinasi makanan
	 */
	public function findFood()
	{   
		$result = $this->combination(Input::get('budget'), Input::get('porsi'));
		if($result === null){
			return Redirect::to('/');
		} else { 
			// var_dump($result);
			return View::make("kombinasi-makanan")->with('menus', $result);
		}
	}

}
