<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Session;
use App\Http\Livewire\Admin\Auth\LoginLog\Log;

class LoginController extends Controller
{
    public function login(){
        //return 'ok';
        if(Auth::user()){
            return redirect()->route('admin.index'); 
        }
        return view('admin.auth.login');
    }

    public function logout(){

        //Login Log
        $LoginLog = new Log();
        //Logout add in log
        $LoginLog->userLogOutLog();

        Session::flush();
        Auth::logout();

        return redirect()->route('login');

    }
}
