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

// Auctions
Route::redirect('/', '/auctions');
Route::view('/auctions', 'pages.auctions')->name('auctions');
Route::get('auctions/add', 'AuctionController@createForm');
Route::get('/auctions/{id?}', 'AuctionController@show')->name('auction');
// User
Route::get('/profile/{id?}', 'BazookerController@show')->name('profile');
Route::get('/account/settings', 'BazookerController@settings');

// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// 404
Route::fallback(function() {
    return view('pages.404');
});