<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
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

    /**
     * Autentikasi user yang mencoba untuk login
     *
     * @author Putra Muttaqin
     */
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
                'password'  => $user->password,
                'total_poin' => $user->total_point
            );
            Session::put('user',$user);
            // menambahkan poin apabila berhasil login, namun poin yg dihitung adalah 1 login tiap hari by Rama Rahmatullah
            $loginTime = Carbon::now();
            DB::table('waktu_login_users')->insert(['email' => $email],['login_time' => $loginTime]);
            $currTime = Carbon::now();
            $userLog = DB::table('waktu_login_users')->select('login_time')->where('email',$email)->orderBy('login_time','desc')->get();
            
            if( empty($userLog[1])   ){
                $lastLogin = Carbon::parse($userLog[0]->login_time);
                $userpoin = DB::table('users')->select('total_point')->where('email', $email)->first();
                $poinuser = $userpoin->total_point;
                $poin = $poinuser + 10;

                DB::table('point_history')->insert(['email' => $email, 'id_point' => 'PFL', 'waktu' => $loginTime, 'nominal_poin' => '10', 'nama_transaksi' => 'login']);
                DB::table('users')->where('email', $email)->update(['total_point' => $poin]);
            } else {
                $lastLogin = Carbon::parse($userLog[1]->login_time);

                if ($currTime->DiffInSeconds($lastLogin) > 86400) {
                    # code...
                    $userpoin = DB::table('users')->select('total_point')->where('email', $email)->first();
                    $poinuser = $userpoin->total_point;
                    $poin = $poinuser + 10;
                    
                    DB::table('point_history')->insert(['email' => $email, 'id_point' => 'PFL', 'waktu' => $loginTime, 'nominal_poin' => '10', 'nama_transaksi' => 'login']);
                    DB::table('users')->where('email', $email)->update(['total_point' => $poin]);    
                }
            }

            return Redirect::to('/home');
            // $loginerr = 'Wrong email or password';
            // return Redirect::to('/home')->with('loginerr',$loginerr);
        } 
        // else { 
        //     Session::put('user',$user);
        //     return Redirect::to('/home');
        // }
    }

    /**
     * Menghilangkan data user yang sudah login sebelumnya
     *
     * @author Putra Muttaqin
     */
    public function logout()
    {
        Session::flush();
        //Session::forget('nama','email','password');
        return Redirect::to('/home');
    }

    /**
     * Mengembalikan profile user
     *
     * @author Putra Muttaqin
     */
    public function profile() {

        return View::make("profile-page");
    }

    /**
     * Konfirmasi perubahan pada data profile
     *
     * @author Putra Muttaqin
     */
    public function confirmEdit(Request $request) {
        $this->validate($request, [
            'nama' => 'min:3|max:255',
            'newPass' => 'min:6',
            'confirmNewPass' => 'same:newPass',
            'desc' => '',
            'currPass' => 'required'
        ]);

        $user = User::where('email',Session::get('user')->email)->first();
        $currPass = Input::get('currPass');
        $nama = Input::get('nama', $user->nama_lengkap);
        $newPass = Input::get('newPass', null);
        $desc = Input::get('desc', $user->deskripsi);

        $pass = empty($newPass) ? $currPass : $newPass;

        if ($currPass == $user->password) {
            if (User::where('email',$user->email)->update(['nama_lengkap' => $nama, 'password' => $pass, 'deskripsi' => $desc])) {
                Session::put('user',User::where('email',Session::get('user')->email)->first());
                return Redirect::to('profile');
            } else {
                return Redirect::to('editProfile')->with('dbErr','Error saat menyimpan ke database')->withInput();
            }       
        } else {
            return Redirect::to('editProfile')->with('passErr','Password Salah!')->withInput();
        }
    }

}
     
                
