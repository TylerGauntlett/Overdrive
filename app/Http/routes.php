<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('user/edit', 'UserController@edit');

Route::patch('user/edit', 'UserController@update');

Route::get('user/paypalPurchase', 'PayPalController@show');

Route::post('user/checkout', 'PayPalController@post');

Route::get('user/paypalPurchase/pay', 'PayPalController@validatePayment');

Route::get('user/successfulpayment', 'PayPalStatusController@showSuccessfulPayment');

Route::get('user/unsuccessfulPayment', 'PayPalStatusController@showUnsuccessfulPayment');

Route::get('user/paypalTransactionHistory', 'PayPalHistoryController@show');

Route::post('user/paypalTransactionHistory', 'PayPalHistoryController@get');