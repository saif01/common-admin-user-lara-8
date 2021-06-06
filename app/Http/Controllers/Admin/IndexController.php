<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        return view('admin.index');
    }

    public function adminAll(){
        return view('admin.users.all');
    }

    //All Roles
    public function rolesAll(){
        return view('admin.roles.all');
    }

    // Setting
    public function setting(){
        return view('admin.setting.contact');
    }

    // slider
    public function slider(){
        return view('admin.setting.slider');
    }

    // background
    public function background(){
        return view('admin.setting.header.background');
    }

    // headerSlider
    public function headerSlider(){
        return view('admin.setting.header.slider');
    }

    // history
    public function history(){
        return view('admin.about.history');
    }

    // vision
    public function vision(){
        return view('admin.about.vision');
    }

    // mission
    public function mission(){
        return view('admin.about.mission');
    }

    // chairman-message
    public function chairmanMessage(){
        return view('admin.about.chairman-message');
    }

    // president-message
    public function presidentMessage(){
        return view('admin.about.president-message');
    }

    // business-operations
    public function businessOperations(){
        return view('admin.about.business-operations');
    }

    // headquarters
    public function headquarters(){
        return view('admin.about.headquarters');
    }






    // News Section

    // press
    public function press(){
        return view('admin.news.press');
    }
 
    // event
    public function event(){
        return view('admin.news.event');
    }

    // gallery
    public function gallery(){
        return view('admin.news.gallery');
    }





    ////// business

    // All
    public function all(){
        return view('admin.business.all');
    }
   

}
