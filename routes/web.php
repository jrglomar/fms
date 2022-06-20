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
});

//-------------ADMIN----------------//

Route::get('admin/dashboard', function () {
    return view('admin/dashboard');
});

Route::get('admin/user', function () {
    return view('admin/user/user', ['page_title' => 'User']);
});


//----------------------------------//
