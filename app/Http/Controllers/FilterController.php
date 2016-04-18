<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FilterController extends Controller
{
    public function index(){
    	return view('/TestFilter')
    }
}
