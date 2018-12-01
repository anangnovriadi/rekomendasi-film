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

/** Front
 * Rekomendasi Film
 */
Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/logout', 'Auth\LogoutController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get('/home', 'HomesController@view')->name('home');