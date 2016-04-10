<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Routing\Redirector;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DB;

class UserController extends Controller
{
    // menampilkan halaman register
    public function index(){
    	return view('register');
    }

    // menyimpan (store) data yg sudah tervalidasi kedatabase
    public function create(Request $request){
        //Users::create($request->all());
        $this->validate($request, [
            'nama_lengkap' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'username' => 'required|min:3'
        ]);


        $user = new User;
        $user->nama_lengkap = Input::get('nama_lengkap');
        $user->username = Input::get('username');
        $user->email = Input::get('email');
        $user->password = bcrypt(Input::get('password'));
        $user->save();
        return redirect('home');
    }

    // melakukan validasi data terhadap input form
    // public function create(Request $request){
    //     $this->store($request);
        
    // }

}
     