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

use Illuminate\Support\Facades\Route;

Route::get('/', "MainController@actionIndex")->name("main");

    //Login register logout
Route::get('/login', "MainController@actionLogin")->name("login");
Route::get('/register', "MainController@actionRegister")->name("register");
Route::get('/logout', "MainController@actionLogout")->name("logout");

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
    Route::get('showgist/{gistid}', "MygistsController@actionShowgist")->name("showmygist");
    Route::post('addgist', "MygistsController@actionAddgist")->name("addgist");
    Route::delete('delgist/{gistid}', "MygistsController@actionDelgist")->name("delgist");
});

    //Files
Route::prefix('files')->group(function (){
    Route::post('addfile',"MyfilesController@actionAddfile")->name("addfile");
    Route::delete('delfile/{fileid}',"MyfilesController@actionDelfile")->name("delfile");
    Route::post('editfile/{fileid}',"MyfilesController@actionEditfile")->name("editfile");
});








