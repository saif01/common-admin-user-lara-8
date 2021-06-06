<?php

namespace App\Http\Livewire\Admin\Auth\LoginLog;

//use Illuminate\Http\Request;

use App\Models\Auth\UserLoginLog;
use App\Http\Livewire\Admin\Auth\LoginLog\AllInfo;
use Auth;



class Log
{

    public function userLoginLog($login_id, $status = 0){

        $data = new UserLoginLog();

        // dd( AllInfo::user_ip_details('202.51.181.142') );

        //status 1=ok, 2=unauthorized user, 3=unauthorized admin, 4=Blocked, 5=unauthorized IT Portal 

        $data->login_id     =  $login_id;
        $data->status       =  $status;
        $data->ip           =  AllInfo::get_ip();
        $data->os           =  AllInfo::get_os();
        $data->browser      =  AllInfo::get_browser();
        $data->device       =  AllInfo::get_device();
        // $data->city         =  AllInfo::get_city();
        // $data->region       =  AllInfo::get_region();
        // $data->country      =  AllInfo::get_country();
        // $data->lat_long     =  AllInfo::get_lat_Long();
        $data->save();
        
    }


    public function userLogOutLog(){

        $login_id = Auth::user()->login;
        $data = UserLoginLog::where('login_id', $login_id)->orderBy('id', 'desc')->first();
        if($data){
            //Current time
            $data->updated_at   =  date('Y-m-d H:i:s');
            $data->save();
        }
      
    }




}