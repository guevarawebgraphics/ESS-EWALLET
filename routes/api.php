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
    // api/servicematrix/UpdateServiceGroup/{id}
    Route::put  ('/UpdateServiceGroup/{id}', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@UpdateServiceGroup'
    ]);
    // api/servicematrix/GetServices
    Route::get('/GetServices', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@get_all_service'
    ]);
    // api/servicematrix/StoreServiceMatrix
    Route::post('/StoreServiceMatrix', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@StoreServiceMatrix'
    ]);
});
/**
 *  @ Wallet Account
 **/
Route::prefix('walletaccount')->group(function(){
    // api/walletaccount/StoreWalletAccountType
    Route::post('/StoreWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@StoreWalletAccountType'
    ]);
     // api/walletaccount/StoreWalletAccountType
     Route::get('/GetAllWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@GetAllWalletAccountType'
    ]);
     // api/walletaccount/UpdateWalletAccountType
     Route::put('/UpdateWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@UpdateWalletAccountType'
    ]);
    // api/walletaccount/StoreWalletAccount
    Route::post('/StoreWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@store_wallet_account'
    ]);
    // api/walletaccount/GetWalletAccount
    Route::get('/GetWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@get_all_wallet_account'
    ]);
});
/**
 *  @ Get Account
 **/
Route::get('/account/{essid}', [
    'uses' => 'Api\\Account\AccountController@GetAccountViaEssId'
]);

// api/servicematrix/GenerateAccountNo
Route::get('/GenerateAccountNo', [
    'uses' => 'Api\\Account\AccountController@GenerateAccountNo'
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

Route::get('/getservicetype/{st_code}',[
    'uses' => 'Api\\Services\ServiceController@fillServiceType'
]);

/***
* Services Type Module
*/
Route::post('/createservice',[
    'uses' => 'Api\\Services\ServiceController@InsertService' 
]);

Route::get('/showservices/{st_id}',[
    'uses' => 'Api\\ServiceType\ServiceTypeController@ShowServices'
]);

Route::get('/getservicetype/{st_code}',[
    'uses' => 'Api\\Services\ServiceController@FillServiceType'
]);

Route::get('/getprwalletdetails/{pr_no}',[
    'uses' => 'Api\\Services\ServiceController@FillPrWalletMethod'
]);

Route::get('/getirwalletdetails/{ir_no}',[
    'uses' => 'Api\\Services\ServiceController@FillIrWalletMethod'
]);

Route::post('/createservicegateway',[
    'uses' => 'Api\\ServiceGateway\ServiceGatewayController@CreateServiceGateway'
]);

Route::get('/getservicegateway' ,[
    'uses' => 'Api\\ServiceGateway\ServiceGatewayController@GetServiceGateway'
]);

Route::put('/updateservicegateway/{gw_id}',[
    'uses' => 'Api\\ServiceGateway\ServiceGatewayController@UpdateServiceGateway'
]);