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
Route::get('/test', "MainController@actionTest")->name("test");

Route::get('/showcat/{caturl}', "MainController@actionIndex")->name("main_categories");

    //Admin
Route::prefix('admin')->middleware(["auth","check_role:Admin"])->
        group(function (){
            Route::get('/find',"MainController@actionAdminFindUser")->name("adminfinduser");
            Route::get('',"MainController@actionAdmin")->name("admin");
            Route::post('/ban', "AdminController@actionBanUser")->name('ban');
            Route::post('/unban', "AdminController@actionUnbanUser")->name("unban");
            Route::post('/verifyemail', "AdminController@actionVerifyUserEmail")->name("verify");
});

Route::get('/notadmin',function (){
    return view('errors.notadmin');
})->name('notadmin');

    //Categories
Route::get('/showcat/{caturl}', "MainController@actionIndex")->name("showcat");
Route::post("/addnewcat","AdminController@actionAddnewcat")->middleware(['auth','isValidUser'])->name("addcat");
Route::post("/changecatname","AdminController@actionChangecatname")->middleware(['auth',"check_role:Admin"])->name("changecatname");

    //Show gist,file
Route::get("/showgist/{gistid}","GistController@actionShowgist")->name("showgist");
Route::get("/showfile/{fileid}","GistController@actionShowfile")->name("showfile");

    //My gists
Route::prefix('mygists')->middleware(['auth','isValidUser'])->group(function (){
    Route::get('', "MygistsController@actionMygists")->name("mygists");
    Route::get('/showcat/{caturl}', "MygistsController@actionMygists")->name("mygists_categories");
    Route::get('/showgist/{gistid}', "MygistsController@actionShowgist")->middleware(['isUserGist'])->name("showmygist");
    Route::post('addgist', "MygistsController@actionAddgist")->name("addgist");
    Route::delete('delgist/{gistid}', "MygistsController@actionDelgist")->middleware(['isUserGist'])->name("delgist");

    //Files
    Route::prefix('files')->group(function (){
        Route::get('showfile/{fileid}',"MyfilesController@actionShowfile")->middleware(['isUserFile'])->name("showfile");
        Route::post('addfile',"MyfilesController@actionAddfile")->name("addfile");
        Route::delete('delfile/{fileid}',"MyfilesController@actionDelfile")->middleware(['isUserFile'])->name("delfile");
        Route::get('showfile/editfile/{fileid}',"MyfilesController@actionEditfile")->middleware(['isUserFile'])->name("editfile");
    });
});

//Profile

Route::get('/profile', "MainController@actionProfile")->middleware(['auth','isValidUser'])->name("profile");
Route::post('/addpic',"ProfileController@actionAddpic")->middleware(['auth','isValidUser'])->name("addpic");
Route::put('/changename',"ProfileController@actionChangename")->middleware(['auth','isValidUser'])->name("changename");
Route::get('/verification_mail_repeat','ProfileController@actionRepeatVerificationMail')->middleware('auth')->name('verification_mail_repeat');
Route::post('/get_token','ProfileController@actionGetToken')->middleware('auth')->name('get_token');

/*vendor/laravel/framework/src/illuminate/routing/router.php
1149 string */

Auth::routes();
Route::get('finalregister/{token}','Auth\FinalRegister@actionFinalRegister')->name('finalregister');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/_logout','MainController@actionLogout')->name('_logout');

//Invalid user actions

Route::get('/invalid_user',function (){
    return view('errors.invalid_user');
})->name('invalid_user');

Route::get('/invalid_resource',function (){
    return view('errors.invalid_resource');
})->name('invalid_resource');

Route::get('/private_resource',function (){
    return view('errors.private_resource');
})->name('private_resource');



//Email browser test

Route::get('/mail',function(){
    $invoice = ["name"=>"Ivan","remember_token"=>"token"];

    return new \App\Mail\EmailConfirmation($invoice);
});
