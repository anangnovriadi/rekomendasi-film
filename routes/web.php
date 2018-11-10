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
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/film', 'Admin\FilmController@index')->name('view.film');
    Route::get('/film/create', 'Admin\FilmController@add')->name('add.film');
    Route::post('/film/create', 'Admin\FilmController@create')->name('create.film');
});

Route::get('/home', 'HomeController@index')->name('home');
