<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', 'Auth\LoginController@getUser');

//API
Route::get('/api/auctions/bids/{id?}', 'ApiController@auction_bids');
Route::get('/api/reviews/bidder/{id?}', 'ApiController@bidder_review');
Route::get('/api/reviews/auctioneer/{id?}', 'ApiController@auctioneer_review');
Route::get('/api/sales', 'ApiController@sales');
Route::get('/api/auctions', 'ApiController@auctions');
