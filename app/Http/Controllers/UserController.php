<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Routing\Redirector;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Session;

class UserController extends Controller
{

    // menyimpan (store) data yg sudah tervalidasi kedatabase
    public function create(Request $request){
        //Users::create($request->all());
        $this->validate($request, [
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        ]);


        $user = new User;
        $user->nama_lengkap = Input::get('nama');
        $user->email = Input::get('email');
        $user->password = (Input::get('password'));
        $user->save();
        return Redirect::to('/home');
    }

    public function dologin()
    {   
        $email = Input::get('email');
        $pass = (Input::get('password'));
        $user= DB::table('users')->where([['email','=',$email],['password','=',$pass]])->first();
        if($user===null){
            echo $email.'<br>';
            echo $pass.'<br>';
            Session::put(array('loginerr' => 'Wrong email or password'));
            return Redirect::to('/home');
        } else { 
            $userdata = array(
                'nama'      => $user->nama_lengkap,
                'email'     => $user->email,
                'password'  => $user->password
            );
            Session::put($userdata);
            return Redirect::to('/home');
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect::to('/home');
    }

}
     