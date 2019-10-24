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
 * @ Service Matrix
 **/
Route::prefix('servicematrix')->group(function(){
    // api/servicematrix/StoreServiceGroup
    Route::post('/StoreServiceGroup', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@StoreServiceGroup'
    ]);
    Route::put  ('/UpdateServiceGroup/{id}', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@UpdateServiceGroup'
    ]);
    // api/servicematrix/GetServices
    Route::get('/GetServices', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@get_all_service'
    ]);
    Route::post('/StoreServiceMatrix', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@StoreServiceMatrix'
    ]);
});
/**
 *  @ Get Account
 **/
Route::get('/account/{essid}', [
    'uses' => 'Api\\Account\AccountController@GetAccountViaEssId'
]);

Route::get('/servicetypetable',[
    'uses' => 'Api\\ServiceType\ServiceTypeController@GetServiceTypeTable'
]);

Route::get('/behavior/{st_id}',[
    'uses' => 'Api\\ServiceType\ServiceTypeController@ServiceTypeSetUp'
]);

Route::put('/updateservicetype/{st_id}', [
    'uses' => 'Api\\ServiceType\ServiceTypeController@SaveServiceDetailsBehavior'
]);

Route::post('/createservicetype',[
    'uses' => 'Api\\ServiceType\ServiceTypeController@SaveServiceType'
]); 

/***
 * Services
 */
Route::post('/createservice',[
    'uses' => 'Api\\Services\ServiceController@InsertService' 
]);