<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});

//-------------AUTH----------------//

Route::get('login', function () {
    return view('auth/login', ['page_title' => 'Login']);
})->name('login');

Route::get('logout', function () {
    return view('auth/logout', ['page_title' => 'Logout']);
})->name('logout');


//-------------ERROR----------------//

Route::get('401', function(){
    return view('error/401', ['page_title' => '401 Unauthenticated']);
})->name('401');

//-------------ADMIN----------------//

Route::group(['middleware' => ['auth']], function(){

    Route::get('admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin_dashboard');

    Route::get('admin/user', function () {
        return view('admin/user/user', ['page_title' => 'User']);
    })->name('admin_user');

});



//----------------------------------//
