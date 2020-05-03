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

//API
Route::get('/api/auctions/bids/{id?}', 'ApiController@auction_bids');
Route::get('/api/reviews/bidder/{id?}', 'ApiController@bidder_review');
Route::get('/api/reviews/auctioneer/{id?}', 'ApiController@auctioneer_review');
Route::get('/api/sales', 'ApiController@sales');
Route::get('/api/auctions', 'ApiController@auctions');

// Auctions/*
Route::view('/auctions', 'pages.auctions')->name('auctions');
Route::get('auctions/add', 'AuctionController@createForm');
Route::get('/auctions/{id?}', 'AuctionController@show')->name('auction');
Route::post('auctions/add', 'AuctionController@create');

// User
Route::get('/profile/{id?}', 'BazookerController@show')->name('profile');
Route::patch('/profile/{bazooker}', 'BazookerController@editProfile');
Route::get('/account/settings', 'BazookerController@settings')->name('settings');
Route::put('/account/settings/password', 'ChangePasswordController');

// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// Static
Route::view('/faq', 'pages.faq')->name('FAQ');
Route::redirect('/', '/auctions');
Route::fallback('FallbackController@notFound');
