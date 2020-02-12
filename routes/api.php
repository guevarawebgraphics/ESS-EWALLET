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
    // api/servicematrix/storeServiceGroup
    Route::post('/storeServiceGroup', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@storeServiceGroup'
    ]);
    // api/servicematrix/UpdateServiceGroup/{id}
    Route::put  ('/updateServiceGroup/{id}', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@updateServiceGroup'
    ]);
    // api/servicematrix/GetAllService
    Route::get('/showAllService', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@showAllService'
    ]);
    // api/servicematrix/GetAllService
    Route::get('/searchServiceGroup/{query}', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@searchServiceGroup'
    ]);
    // api/servicematrix/storeServiceMatrix
    Route::post('/storeServiceMatrix', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@storeServiceMatrix'
    ]);
    // api/servicematrix/GetServices
    Route::get('/showServices', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@showServices'
    ]);

    // api/servicematrix/showServiceMatrixConfig
    Route::get('/ServiceMatrixConfig', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@showServiceMatrixConfig'
    ]);

    // api/servicematrix/GetServiceMatrixConfig
    Route::get('/searchServiceMatrix/{query}', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@searchServiceMatrix'
    ]);
});
/**
 *  @ Wallet Account
 **/
Route::prefix('walletaccount')->group(function(){
    // api/walletaccount/StoreWalletAccountType
    Route::post('/storeWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@storeWalletAccountType'
    ]);
     // api/walletaccount/showWalletAccountTypes
     Route::get('/showWalletAccountTypes', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@showWalletAccountTypes'
    ]);
     // api/walletaccount/showAllWalletAccountType
     Route::get('/showAllWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@showAllWalletAccountType'
    ]);
     // api/walletaccount/searchWalletAccountType
     Route::get('/searchWalletAccountType/{q}', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@searchWalletAccountType'
    ]);
     // api/walletaccount/updateWalletAccountType
     Route::put('/updateWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@updateWalletAccountType'
    ]);
    // api/walletaccount/storeWalletAccount
    Route::post('/storeWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@storeWalletAccount'
    ]);
    // api/walletaccount/updateWalletAccount
    Route::post('/updateWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@updateWalletAccount'
    ]);
    // api/walletaccount/GetWalletAccount
    Route::get('/showAllWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@showAllWalletAccount'
    ]);
    // api/walletaccount/showWalletAccountDetails
    Route::get('/showWalletAccountDetails/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@showWalletAccountDetails'
    ]);
    // api/walletaccount/storeServiceMatrixConfig
    Route::post('/storeServiceMatrixConfig/{wai}', [
            'uses' => 'Api\\WalletAccount\WalletAccountController@storeServiceMatrixConfig'
    ]);
    // api/walletaccount/showServiceMatrixConfig
    Route::get('/showServiceMatrixConfig/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@showServiceMatrixConfig'
    ]);
    // api/walletaccount/showWalletBankAccount
    Route::get('/showWalletBankAccount/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@showWalletBankAccount'
    ]);
    // api/walletaccount/searchWalletAccountNo
    Route::get('/searchWalletAccountNo/{wand}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@searchWalletAccountNo'
    ]);
    // api/walletaccount/updateServiceMatrixConfig
    Route::put('/updateServiceMatrixConfig/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@updateServiceMatrixConfig'
    ]);
    // api/walletaccount/searchWalletJointAccount
    Route::get('/searchWalletJointAccount/{wan}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@searchWalletJointAccount'
    ]);
    // api/walletaccount/showListWalletAccounts
    Route::get('/showListWalletAccounts', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@showListWalletAccounts'
    ]);
    // api/walletaccount/searchlistwalletaccount
    Route::get('/searchlistwalletaccount/{query}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@searchListWalletAccount'
    ]);
    // api/walletacccount/ListofMerchantsAccounts
    Route::get('/ListofMerchantsAccounts', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@ListofMerchantsAccounts'
    ]);
    // api/walletacccount/ListofMerchantsAccounts
    Route::get('/searchWalletAccount/{q}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@searchWalletAccount'
    ]);
    // api/walletacccount/showservicematrix
    Route::get('/showservicematrix', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@showServiceMatrix'
    ]);
});
/**
 *  @ Get Account
 **/
Route::get('/account/{essid}', [
    'uses' => 'Api\\Account\AccountController@showAccountViaEssId'
]);

// api/servicematrix/GenerateAccountNo
Route::get('/GenerateAccountNo', [
    'uses' => 'Api\\Account\AccountController@GenerateAccountNo'
]);


/***
* Services
*/ 
Route::prefix('service')->group(function(){ 

    Route::post('/storeService',[
        'uses' => 'Api\\Services\ServiceController@storeService' 
    ]);
    Route::post('/updateservice',[
        'uses' => 'Api\\Services\ServiceController@updateService' 
    ]);
    
    Route::get('/getservicetype/{st_code}',[
        'uses' => 'Api\\Services\ServiceController@fillServiceType'
    ]); 
    
    Route::get('/getserviceslist',[
        'uses' => 'Api\\Services\ServiceController@showService'
    ]); 
    
    Route::post('/storeService',[
        'uses' => 'Api\\Services\ServiceController@storeService' 
    ]);  

    Route::post('/storetJointServices',[
        'uses' => 'Api\\Services\ServiceController@storetJointServices' 
    ]); 
    
    Route::get('/getservicetype/{st_code}',[
        'uses' => 'Api\\Services\ServiceController@FillServiceType'
    ]);
    
    Route::get('/getprwalletdetails/{pr_no}',[
        'uses' => 'Api\\Services\ServiceController@fillPrWallet'
    ]);
    
    Route::get('/getirwalletdetails/{ir_no}',[
        'uses' => 'Api\\Services\ServiceController@fillIrWallet'
    ]); 

    Route::get('/getservicedetails/{service_id}',[
        'uses' => 'Api\\Services\ServiceController@getServiceDetails'
    ]);

    Route::get('/getwalletdetails/{id}',[
        'uses' => 'Api\\Services\ServiceController@getWalletDetails'
    ]);
    Route::get('/getvsdr/{service_id}',[
        'uses' => 'Api\\Services\ServiceController@getVSDR'
    ]);
    Route::get('/getjointservicelist/{id}',[
        'uses' => 'Api\\Services\ServiceController@getJointServicesList'
    ]);
    Route::get('/getservicetypecode/{id}/{wallet_condition}',[
        'uses' => 'Api\\Services\ServiceController@getServiceTypeCode'
    ]);

    // api/service/listservices
    Route::get('/listservices', [
        'uses' => 'Api\\Services\ServiceController@showListServices'
    ]);

    // api/service/searchlistofservices
    Route::get('/searchlistofservices/{query}', [
        'uses' => 'Api\\Services\ServiceController@searchListOfServices'
    ]);
     
});
    /**
    * Services Type Module
    */
Route::prefix('service_type')->group(function(){
    Route::get('/showservices/{st_id}',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@showServices'
    ]); 
    Route::get('/showServiceTypeDetails',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@showServiceTypeDetails'
    ]);
    
    Route::get('/behavior/{st_id}',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@serviceTypeSetUp'
    ]);
    
    Route::put('/updateservicetype/{st_id}', [
        'uses' => 'Api\\ServiceType\ServiceTypeController@saveServiceDetailsBehavior'
    ]);
    
    Route::post('/storeservicetype',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@storeServiceType'
    ]);  

    Route::post('/updateservicetype/templates',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@saveServiceTemplates'
    ]);

    Route::get('/searchservicetype/{query}',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@searchServiceType'
    ]);
});
    
    /**
    * Service Gateway
    */ 
Route::prefix('service_gateway')->group(function(){
    Route::post('/storeServiceGateway',[
        'uses' => 'Api\\ServiceGateway\ServiceGatewayController@storeServiceGateway'
    ]);
    
    Route::get('/getservicegateway' ,[
        'uses' => 'Api\\ServiceGateway\ServiceGatewayController@showServiceGateway'
    ]);
    
    Route::put('/updateservicegateway/{gw_id}',[
        'uses' => 'Api\\ServiceGateway\ServiceGatewayController@updateServiceGateway'
    ]);

    Route::get('/searchServiceGateway/{query}' ,[
        'uses' => 'Api\\ServiceGateway\ServiceGatewayController@searchServiceGateway'
    ]);
});

/**
 * @ Transaction 
 **/

 // Prefund
// api/transaction/storeprefund
 Route::prefix('transaction')->group(function(){
    // api/transaction/storeprefund
    Route::post('/storeprefund', [
        'uses' => 'Api\\Transaction\PrefundController@storePrefund'
    ]);

    // api/transaction/updatePrefundStatus
    Route::post('/updatePrefundStatus/{id}', [
        'uses' => 'Api\\Transaction\PrefundController@updatePrefundStatus'
    ]);
    
    // api/transaction/storeputmoney
    Route::post('/storePutMoney', [
        'uses' => 'Api\\Transaction\PutMoneyController@storePutMoney'
    ]);
 });

 // Approval
 Route::prefix('approval')->group(function () {
    // api/approval/showapprovaltransaction
    Route::get('/showapprovaltransaction', [
        'uses' => 'Api\\Approval\ApprovalController@showApprovalTransaction'
    ]);

    // api/approval/showapprovaltransaction
    Route::get('/searchapprovaltransaction/{query}', [
        'uses' => 'Api\\Approval\ApprovalController@searchApprovalTransaction'
    ]);
 });


/**
* Services Rates Module
*/
Route::prefix('servicerates')->group(function(){
    Route::get('/showAllServiceRates',[
        'uses' => 'Api\\ServiceRates\ServiceRatesController@showAllServiceRates'
    ]); 
    Route::post('/storeServiceRates',[
        'uses' => 'Api\\ServiceRates\ServiceRatesController@storeServiceRates'
    ]); 
    Route::post('/updateServiceRates',[
        'uses' => 'Api\\ServiceRates\ServiceRatesController@updateServiceRates'
    ]); 
});

 // Gate
 Route::get('/auth-gate', [
    'uses' => 'Api\Gate\GateController@gate'
 ]);