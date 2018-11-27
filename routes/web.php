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

/** Front
 * Rekomendasi Film
 */
// Route::get('/home', 'HomeController@index')->name('home');


/** Admin
 * Rekomendasi Film
 */
Route::prefix('admin')->group(function() {
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/film', 'Admin\FilmController@view')->name('view.film');
    Route::get('/film/create', 'Admin\FilmController@add')->name('add.film');
    Route::post('/film/create', 'Admin\FilmController@create')->name('create.film');
});
