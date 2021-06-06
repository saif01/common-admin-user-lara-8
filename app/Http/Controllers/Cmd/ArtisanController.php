<?php

namespace App\Http\Controllers\Cmd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Artisan;

class ArtisanController extends Controller
{
    public function index(){
        return view('cmd.all');
    }


    public function config(){

        Artisan::call('config:cache');
        return redirect()->back();
        //var_dump('Clear Config cleared <br>', $output);
        
    }

    public function optimize(){

        //\ob_start();

        Artisan::call('optimize');

        return redirect()->back();

        //$output = \ob_get_clean();

        //var_dump('optimized all file created <br>', $output);
        

    }

    public function cacheClear(){

        //\ob_start();
        Artisan::call('cache:clear');
        // $output = \ob_get_clean();
        // var_dump('Cache facade value cleared <br>', $output);

        return redirect()->back();

    }

    public function routeCache(){

        //\ob_start();
        Artisan::call('route:cache');
        // $output = \ob_get_clean();
        // var_dump('Routes cached <br>', $output);
        
        return redirect()->back();

    }

    public function routeClear(){

        //\ob_start();
        Artisan::call('route:clear');
        //$output = \ob_get_clean();
        //var_dump('Route cache cleared <br>', $output);
        return redirect()->back();

    }

    public function viewClear(){

        //\ob_start();
        Artisan::call('view:clear');
        $output = \ob_get_clean();
       // var_dump('View cache cleared <br>', $output);
       return redirect()->back();

    }


    public function clear(){
        Artisan::call('optimize:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return 'All Clear';

    }
}
