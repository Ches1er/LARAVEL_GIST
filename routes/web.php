<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', "MainController@actionIndex")->name("main");
Route::get('/showcat/{caturl}', "MainController@actionIndex")->name("main_categories");


    //Profile
Route::get('/profile', "MainController@actionProfile")->name("profile");

    //Admin
Route::get('/admin', "MainController@actionAdmin")->name("admin");

    //Categories
Route::get('/showcat/{caturl}', "MainController@actionIndex")->name("showcat");

    //Show gist,file
Route::get("/showgist/{gistid}","GistController@actionShowgist")->name("showgist");
Route::get("/showfile/{fileid}","GistController@actionShowfile")->name("showfile");

    //My gists
Route::prefix('mygists')->group(function (){
    Route::get('', "MygistsController@actionMygists")->name("mygists");
    Route::get('/showcat/{caturl}', "MygistsController@actionMygists")->name("mygists_categories");
    Route::get('/{gistid}', "MygistsController@actionShowgist")->name("showmygist");
    Route::post('addgist', "MygistsController@actionAddgist")->name("addgist");
    Route::delete('delgist/{gistid}', "MygistsController@actionDelgist")->name("delgist");

    //Files
    Route::prefix('files')->group(function (){
        Route::get('showfile/{fileid}',"MyfilesController@actionShowfile")->name("showfile");
        Route::post('addfile',"MyfilesController@actionAddfile")->name("addfile");
        Route::delete('delfile/{fileid}',"MyfilesController@actionDelfile")->name("delfile");
        Route::get('showfile/editfile/{fileid}',"MyfilesController@actionEditfile")->name("editfile");
    });
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
