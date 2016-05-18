<?php 

namespace App\Http\Controllers;

use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

use App\Menu;
use App\Restoran;
use App\FasilitasRestoran;
use App\JenisMasakan;
use App\WaktuOperasional;

use Session;
use Validator;


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

	public function viewMenu(Request $request, $id){
		if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin',Session::get('user')->email)->first();
		$menu = Menu::find($id);
        if($menu->id_restoran != $restoran->id) {
        	echo $menu->nama;
        	echo $menu->id_restoran;
        	echo $restoran->id;
        	//return Redirect::to('profileRestoran');
        }
		return view('view-menu')->with('restoran', $restoran)->with('menu', $menu)->with('user', $user);
	}

	public function editMenu(Request $request, $id){
		if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin',Session::get('user')->email)->first();
		$menu = Menu::find($id);
		if($menu->id_restoran != $restoran->id) {
        	return Redirect::to('profileRestoran');
        }
		return view('edit-menu')->with('restoran', $restoran)->with('menu', $menu)->with('user', $user);
	}

	public function deleteMenu(Request $request){
		if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin',Session::get('user')->email)->first();
		$menu = Menu::find($id);
		if($menu->id_restoran != $restoran->id) {
        	return Redirect::to('profileRestoran');
        }
		return Redirect::to('/editMenuRestoran');
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

	public function fotoMenu(Request $request, $id){
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
		    return Redirect::to('editMenu/'.$id.'')->withInput()->withErrors($validator);
		  }
		  else {
		    // checking file is valid.
		    if (Input::file('image')->isValid()) {
		      $destinationPath = 'uploads'; // upload path
		      $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
		      $fileName = "m".$id.'.'."png"; // renameing image
		      Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
		      // sending back with message
		      Session::flash('success', 'Upload successfully'); 
		      Menu::where('id',$id)->update(['id_photo' => $fileName]);
		      return Redirect::to('viewMenu/'.$id.'');
		    }
		    else {
		      // sending back with error message.
		      Session::flash('error', 'uploaded file is not valid');
		      return Redirect::to('editMenu/'.$id.'');
		    }
		  }
	}

	public function editMenuHelper(Request $request, $id) {
		return Redirect::to('editMenu/'.$id.'');
	}

	public function confirmEditMenu(Request $request, $id) {
        $this->validate($request, [
            'nama' => 'required | max:100',
            'harga' => 'required | numeric', 
            'kapasitas' => 'required | numeric', 
            'jenis' => 'required | max:30',
            'desc' => '',
            'kategori' => '',
            'paket' => '',
            'currPass' => 'required'
        ]);
        $user = Session::get('user');
        $restoran = Restoran::where('admin',Session::get('user')->email)->first();
        $menu = Menu::find($id);
        if($menu->id_restoran != $restoran->id) {
        	return Redirect::to('profileRestoran');
        }
        $currPass = Input::get('currPass');
        $nama = Input::get('nama');
        $harga = Input::get('harga');
        $kapasitas = Input::get('kapasitas');
        $jenis = Input::get('jenis');
        $desc = Input::get('desc');
		$kategori = Input::get('kategori');
        $paket = Input::get('paket');

        if ($currPass == $user->password) {
        	if($paket == "Bukan Paket") {
        		$pa = false;
        	} else if ($paket == "Paket Tanpa Minum"){
        		$sa = false;
        	}

        	if(!$pa){
        		$status = Menu::where('id',$menu->id)->update(['nama' => $nama, 'harga' => $harga, 'kapasitas' => $kapasitas,'jenis' => $kategori , 'deskripsi' => $desc, 'kategori' => $jenis , 'is_paket_tanpa_minum' => null,'is_paket_dgn_minum' => null ]);
        	} else {
        		$status = Menu::where('id',$menu->id)->update(['nama' => $nama, 'harga' => $harga, 'kapasitas' => $kapasitas,'jenis' => $kategori , 'deskripsi' => $desc, 'kategori' => $jenis , 'is_paket_tanpa_minum' => !$sa,'is_paket_dgn_minum' => $sa ]);
        	}
            if ($status) {
                return Redirect::to('viewMenu/'.$id.'');
            } else {
                return Redirect::to('editMenu/'.$id.'')->with('dbErr','Error saat menyimpan ke database')->withInput();
            }       
        } else {
            return Redirect::to('editMenu/'.$id.'')->with('passErr','Password Salah!')->withInput();
        }
    }

    public function searchMenu(Request $request){
    	if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$key = Input::get('searchMenu');
		if(Session::has('key')){
			$key = Session::get('key');
		}
		$user = $request->session()->get('user')->email;
		Session::put('key', $key);
		$restoran = Restoran::where('admin',Session::get('user')->email)->first();
		$menus = Menu::where('id_restoran',$restoran->id)->where('nama', 'LIKE', '%'.$key.'%')->orderBy('nama', 'ASC')->paginate(10);
		return view('view-menu-search')->with('restoran', $restoran)->with('menus', $menus)->with('key', $key)->with('user', $user);
    }

    public function addMenu(Request $request){
    	if(!Session::has('user')){
			return Redirect::to('/home');
		}
		$client = $request->session()->get('user')->isClient;
		if(!$client){
			return Redirect::to('/home');
		}
		$key = Input::get('searchMenu');
		$user = $request->session()->get('user')->email;
		$restoran = Restoran::where('admin',Session::get('user')->email)->first();
		return view('add-menu')->with('restoran', $restoran)->with('user', $user);
    }

    public function confirmAddMenu(Request $request) {
        $this->validate($request, [
            'nama' => 'required | max:100',
            'harga' => 'required | numeric', 
            'kapasitas' => 'required | numeric', 
            'jenis' => 'required | max:30',
            'desc' => '',
            'kategori' => '',
            'paket' => '',
            'currPass' => 'required'
        ]);
        $user = Session::get('user');
        $restoran = Restoran::where('admin',Session::get('user')->email)->first();

        $currPass = Input::get('currPass');
        $nama = Input::get('nama');
        $harga = Input::get('harga');
        $kapasitas = Input::get('kapasitas');
        $jenis = Input::get('jenis');
        $desc = Input::get('desc');
		$kategori = Input::get('kategori');
        $paket = $request->input('paket');


        if ($currPass == $user->password) {
        	if($paket == "Bukan Paket") {
        		$pa = false;
        	} else if ($paket == "Paket Tanpa Minum"){
        		$sa = false;
        	}
        	if(!$pa){
        		$menu = Menu::create(array('nama' => $nama, 'harga' => $harga, 'kapasitas' => $kapasitas, 'id_restoran'=> $restoran->id, 'jenis' => $kategori , 'id_photo'=>'', 'deskripsi' => $desc, 'kategori' => $jenis , 'is_paket_tanpa_minum' => null,'is_paket_dgn_minum' => null ));
        	} else {
        		$menu = Menu::create(array('nama' => $nama, 'harga' => $harga, 'kapasitas' => $kapasitas, 'id_restoran'=> $restoran->id, 'jenis' => $kategori , 'id_photo'=>'', 'deskripsi' => $desc, 'kategori' => $jenis , 'is_paket_tanpa_minum' => !$sa,'is_paket_dgn_minum' => $sa ));
        	}
            $id = $menu->id;
        	if(Input::has('image')){
        		// getting all of the post data
		  		$file = array('image' => Input::file('image'));
		  		// setting up rules
		  		$rules = array('image' => '',); //mimes:jpeg,bmp,png and for max size max:10000
		  		// doing the validation, passing post data, rules and the messages
		  		$validator = Validator::make($file, $rules);
		  		if ($validator->fails()) {
		    		// send back to the page with the input data and errors
		    		return Redirect::to('addMenu')->withInput()->withErrors($validator);
		 		 }
		  		else {
		    		// checking file is valid.
		    		if (Input::file('image')->isValid()) {
		     			$destinationPath = 'uploads'; // upload path
		      			$extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
		      			$fileName = "m".$id.'.'."png"; // renameing image
		      			Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
		      			// sending back with message
		      			Session::flash('success', 'Upload successfully'); 
		      			Menu::where('id',$id)->update(['id_photo' => $fileName]);
		      			return Redirect::to('viewMenu/'.$id.'');
		    		}
		    		else {
		      			// sending back with error message.
		     			Session::flash('error', 'uploaded file is not valid');
		     			Menu::find($id)->delete();
		     			return Redirect::to('addMenu')->withInput();
		    		}
	  			}
        	}
            return Redirect::to('viewMenu/'.$id.'');     
        } else {
            return Redirect::to('addMenu')->with('passErr','Password Salah!')->withInput();
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
		$j = 0;
		$result = [];
		$main= DB::table('menus')->join('restorans', 'menus.id_restoran', '=', 'restorans.id')->select(DB::raw('restorans.id as resto_id, restorans.nama as nama_resto, restorans.lokasi as lokasi, restorans.tax as tax, menus.nama as nama_menu, menus.harga as harga, menus.kapasitas as porsi, menus.jenis as jenis, menus.deskripsi as deskripsi, menus.id_photo as photo_menu, menus.rate as rate_menu, menus.jumlah_tested as jumlah_tested, menus.is_paket_tanpa_minum as tanpa_minuman'))->where([['harga','<=',$budget],['kapasitas','<=',$porsi],['jenis','=','Makanan Utama']])->orderBy('id_restoran')->orderBy('harga')->get();
		$drinks= DB::table('menus')->join('restorans', 'menus.id_restoran', '=', 'restorans.id')->select(DB::raw('restorans.id as resto_id, restorans.nama as nama_resto, restorans.lokasi as lokasi, restorans.tax as tax, menus.nama as nama_menu, menus.harga as harga, menus.kapasitas as porsi, menus.jenis as jenis, menus.deskripsi as deskripsi, menus.id_photo as photo_menu, menus.rate as rate_menu, menus.jumlah_tested as jumlah_tested, menus.is_paket_tanpa_minum as tanpa_minuman'))->where([['harga','<=',$budget],['kapasitas','<=',$porsi],['jenis','=','Minuman']])->orderBy('id_restoran')->orderBy('harga')->get();
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
					$i++;
					if ($i>600) return $result;
				}
			}
		}
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
