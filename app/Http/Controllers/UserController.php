<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
            'password' => 'required|min:6|required',
            're-pass' => 'required|same:password',
        ]);


        $user = new User;
        $user->nama_lengkap = Input::get('nama');
        $user->email = Input::get('email');
        $user->password = Input::get('password');
        $user->save();
        return Redirect::to('/home');
    }

    public function dologin()
    {   
        $email = Input::get('email');
        $pass = (Input::get('password'));
        $user= DB::table('users')->where([['email','=',$email],['password','=',$pass]])->first();
        if($user===null){
            $loginerr = 'Wrong email or password';
            return Redirect::to('/home')->with('loginerr',$loginerr);
        } else { 
            $userdata = array(
                'nama'      => $user->nama_lengkap,
                'email'     => $user->email,
                'password'  => $user->password
            );
            Session::put('user',$user);
            return Redirect::to('/home');
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect::to('/home');
    }

    /**
     * mengembalikan profile user
     *
     * @author Putra Muttaqin
     */
    public function profile() {
        return View::make("profile-page");
    }

}
     