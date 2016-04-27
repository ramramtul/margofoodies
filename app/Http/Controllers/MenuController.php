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
		$menu = Menu::where('nama', 'like', $temp)->get();
		for ($i = 0; $i < count($menu); $i++) {
			$id = $menu[$i]->id_restoran;
			$resto = Restoran::find($id);
			$menu[$i]->resto = $resto->nama;
		}
		return view('view-search')->with('menu', $menu);
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

	public function findFood()
    {   
        $menus= DB::table('menus')->where([['harga','<=',Input::get('budget')],['kapasitas','<=',Input::get('porsi')]])->get();
        if($menus===null){
            return Redirect::to('/');
        } else { 
            return View::make("food-combination")->with('menus', $menus);
        }
    }

}
