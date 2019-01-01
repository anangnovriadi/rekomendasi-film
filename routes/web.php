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
Route::prefix('admin')->group(function () {
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/film', 'Admin\FilmController@view')->name('view.film');
    Route::get('/film/create', 'Admin\FilmController@add')->name('add.film');
    Route::post('/film/create', 'Admin\FilmController@create')->name('create.film');

    Route::get('/genre', 'Admin\GenreController@view')->name('view.genre');
    Route::get('/genre/create', 'Admin\GenreController@add')->name('add.genre');
    Route::post('/genre/create', 'Admin\GenreController@create')->name('create.genre');

    Route::get('/user', 'Admin\UserController@index')->name('view.user');
});

/** Front
 * Rekomendasi Film
 */
Auth::routes();
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/logout', 'Auth\LogoutController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/register/autocomplete', 'Auth\RegisterController@fetch')->name('register.autocomplete');
Route::get('/home', 'HomesController@view')->name('home');
Route::get('/profile', 'ProfileController@view')->name('profile');
Route::post('/profile', 'ProfileController@update')->name('edit.profile');
Route::get('/all-film', 'ListFilmController@view')->name('film');
Route::get('/detail-film/{slug}', 'ListFilmController@detail')->name('detail.film');
Route::any('/search-film', 'SearchController@search')->name('search.film');
Route::get('/knn', 'KnnController@index');

Route::get('/autocomplete', 'AutoComplete@index');
Route::post('/autocomplete/fetch', 'AutoComplete@fetch')->name('autocomplete.fetch');