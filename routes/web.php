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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/form-login', function () {
//     return view('front.auth.form-login');
// });

// Route::get('/dashboard', function () {
//     return view('front.dashboard.home');
// });

Route::prefix('admin')->group(function() {
    // Route::get('/dashboard', function() {
    //     return view('admin.dashboard');
    // });

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
});

Route::get('/home', 'HomeController@index')->name('home');
