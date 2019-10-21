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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users', 'Auth\\RegisterController@get_all_users');

Route::post('/ValidateFirstStep', 'Api\\WalletAccount\WalletAccountController@ValidateFirstStep');

/**
 *  @ Get Account
 **/
Route::get('/account/{essid}', [
    'uses' => 'Api\\Account\AccountController@GetAccountViaEssId'
]);