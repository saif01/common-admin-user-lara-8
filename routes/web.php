<?php

use Illuminate\Support\Facades\Route;

Route::middleware('cors')->group(function(){

    // FrontEnd Start
    Route::namespace('App\Http\Controllers\FrontEnd')->group(function(){

        Route::get('/', 'IndexController@index')->name('index');

    });
    // FrontEnd End

    // Auth Start
    Route::namespace('App\Http\Controllers\Admin\Auth')->prefix('admin')->group(function(){
        Route::get('/login', 'LoginController@login')->name('login');
        Route::get('/logout', 'LoginController@logout')->name('logout');
    });
    // Auth End

    // Admin Start
    Route::middleware('auth')->namespace('App\Http\Controllers\Admin')->prefix('admin')->group(function(){

        Route::get('/', 'IndexController@index')->name('admin.index');

        Route::get('/all', 'IndexController@adminAll')->name('admin.all')->middleware('can:adminManage');
        Route::get('/roles-all', 'IndexController@rolesAll')->name('roles.all')->middleware('can:roleManage');

    });
    // Admin End







    // Artisan Start
    Route::namespace('App\Http\Controllers\Cmd')->prefix('cmd')->group( function () {
        
        Route::get('/', 'ArtisanController@index')->name('cmd.index');
        Route::get('config-cache', 'ArtisanController@config')->name('cmd.config.cache');
        Route::get('optimize', 'ArtisanController@optimize')->name('cmd.config.optimize');
        //Clear Cache facade value:
        Route::get('cache-clear', 'ArtisanController@cacheClear')->name('cmd.cache.clear');
        //Route cache:
        Route::get('route-cache', 'ArtisanController@routeCache')->name('cmd.route.cache');
        //Clear Route cache:
        Route::get('route-clear', 'ArtisanController@routeClear')->name('cmd.route.clear');
        //Clear View cache:
        Route::get('view-clear', 'ArtisanController@viewClear')->name('cmd.view.clear');
        Route::get('clear', 'ArtisanController@clear')->name('cmd.clear');

    });
    // Artisan End


});
