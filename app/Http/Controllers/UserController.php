<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            // menambahkan poin apabila berhasil login, namun poin yg dihitung adalah 1 login tiap hari by Rama Rahmatullah
            $loginTime = Carbon::now();
            DB::table('waktu_login_users')->insert(['email' => $email],['login_time' => $loginTime]);
            $currTime = Carbon::now();
            $userLog = DB::table('waktu_login_users')->select('login_time')->where('email',$email)->orderBy('login_time','desc')->first();
            $lastLogin = Carbon::parse($userLog->login_time);

            if($currTime->DiffInHours($lastLogin) < 24) {
                if(is_null ( $lastLogin ) ){
                    $userpoin = DB::table('users')->select('total_point')->where('email', $email)->first();
                    $poinuser = $userpoin->total_point;
                    $poin = $poinuser + 10;
                    
                    DB::table('users')->where('email', $email)->update(['total_point' => $poin]);    
                }
            } else 
            if ($currTime->DiffInHours($lastLogin) > 24) {
                # code...
                $userpoin = DB::table('users')->select('total_point')->where('email', $email)->first();
                $poinuser = $userpoin->total_point;
                $poin = $poinuser + 10;
                
                DB::table('users')->where('email', $email)->update(['total_point' => $poin]);    
     
            }
            
            return Redirect::to('/home');
        }
    }

    public function logout()
    {
        //Session::flush();
        Session::forget('nama','email','password');
        return Redirect::to('/home');
    }

}
     