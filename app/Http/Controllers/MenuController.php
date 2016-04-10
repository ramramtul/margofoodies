<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    public function findFood()
    {   
        $menus= DB::table('menus')->where([['harga','<=',Input::get('budget')],['kapasitas','<=',Input::get('porsi')]])->get();
        if($menus===null){
            return Redirect::to('/');
        } else { 
            return View::make("foodcombo")->with(array('data'=>$menus));
        }
    }
}