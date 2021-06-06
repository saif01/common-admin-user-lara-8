<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // index
    public function index(){
        return view('front-end.index');
    }

    // history
    public function history(){
        return view('front-end.about.history');
    }

    // headquarters
    public function headquarters(){
        return view('front-end.about.headquarter');
    }

    // vision
    public function vision(){
        return view('front-end.about.vision');
    }

    // mission
    public function mission(){
        return view('front-end.about.mission');
    }

    // chairmanMessage
    public function chairmanMessage(){
        return view('front-end.about.chairman-message');
    }

    //presidentMessage
    public function presidentMessage(){
        return view('front-end.about.president-message');
    }

    //contact
    public function contact(){
        return view('front-end.contact');
    }




    //news

    //press
    public function press(){
        return view('front-end.news.press');
    }

    // event
    public function event(){
        return view('front-end.news.event');
    }

    // gallery
    public function gallery(){
        return view('front-end.news.gallery');
    }




    ///// /// business

    // business
    public function business($name){
        return view('front-end.business.all', compact('name'));
    }


}
