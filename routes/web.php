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

Route::redirect('/', '/auctions');

// Auctions/*
Route::view('/auctions', 'pages.auctions')->name('auctions');
Route::get('/auctions/query', 'AuctionController@query')->name('query');
Route::get('/auctions/add', 'AuctionController@createForm');
Route::get('/auctions/{id?}', 'AuctionController@show')->name('auction');
Route::post('/auctions/add', 'AuctionController@create');
Route::post('/auctions/{id}/bid', 'AuctionController@bid');

// User aka Bazooker
Route::get('/profile/{id?}', 'BazookerController@show')->name('profile');
Route::patch('/profile/{bazooker}', 'BazookerController@editProfile');
Route::get('/account/settings', 'BazookerController@settings')->name('settings');
Route::put('/account/settings/password', 'ChangePasswordController@changeBazookerPass');
Route::post('/account/settings/payment', 'PaymentMethodController@create');
Route::delete('/account/settings/payment', 'PaymentMethodController@remove');

Route::get('/activity', 'BazookerController@activityPage')->name('activity');
Route::get('/activity/myauctions', 'AuctionController@myAuctions')->name('myauctions');
Route::get('/activity/mybids', 'AuctionController@myBids')->name('mybids');


// Authentication
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

// Dashboard
Route::get('/mod', 'Dashboard\IndexController@show')->name('dashboard');
Route::get('/mod/auctions', 'Dashboard\AuctionController@show');
Route::get('/mod/certifications', 'Dashboard\CertificationController@show');
Route::patch('/mod/certifications/{certification}', 'Dashboard\CertificationController@updateStatus');
Route::get('/mod/users', 'Dashboard\UserController@show');
Route::get('/mod/moderators', 'Dashboard\ModeratorController@show');
Route::post('mod/auctions/freeze/{id?}','Dashboard\AuctionController@freeze');
Route::delete('mod/auctions/{id?}','Dashboard\AuctionController@delete');

// Static
Route::view('/faq', 'pages.faq')->name('FAQ');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/terms', 'pages.terms')->name('terms');
Route::fallback('FallbackController@notFound');
