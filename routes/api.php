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
    // api/servicematrix/GetAllService
    Route::get('/GetAllService', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@GetAllService'
    ]);
    // api/servicematrix/GetAllService
    Route::get('/searchServiceGroup/{query}', [
        'uses' => 'Api\\ServiceMatrix\ServiceGroupController@searchServiceGroup'
    ]);
    // api/servicematrix/StoreServiceMatrix
    Route::post('/StoreServiceMatrix', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@StoreServiceMatrix'
    ]);
    // api/servicematrix/GetServices
    Route::get('/GetServices', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@GetServices'
    ]);

    // api/servicematrix/GetServiceMatrixConfig
    Route::get('/ServiceMatrixConfig', [
        'uses' => 'Api\\ServiceMatrix\ServiceMatrixController@GetServiceMatrixConfig'
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
    Route::post('/StoreWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@StoreWalletAccountType'
    ]);
     // api/walletaccount/StoreWalletAccountType
     Route::get('/GetAllWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@GetAllWalletAccountType'
    ]);
     // api/walletaccount/StoreWalletAccountType
     Route::get('/showAllWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@showAllWalletAccountType'
    ]);
     // api/walletaccount/searchWalletAccountType
     Route::get('/searchWalletAccountType/{q}', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@searchWalletAccountType'
    ]);
     // api/walletaccount/UpdateWalletAccountType
     Route::put('/UpdateWalletAccountType', [
        'uses' => 'Api\\WalletAccountType\WalletAccountTypeController@UpdateWalletAccountType'
    ]);
    // api/walletaccount/StoreWalletAccount
    Route::post('/StoreWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@StoreWalletAccount'
    ]);
    // api/walletaccount/UpdateWalletAccount
    Route::post('/UpdateWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@UpdateWalletAccount'
    ]);
    // api/walletaccount/GetWalletAccount
    Route::get('/GetAllWalletAccount', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@GetAllWalletAccount'
    ]);
    // api/walletaccount/GetWalletAccountDetails
    Route::get('/GetWalletAccountDetails/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@GetWalletAccountDetails'
    ]);
    // api/walletaccount/StoreServiceMatrixConfig
    Route::post('/StoreServiceMatrixConfig/{wai}', [
            'uses' => 'Api\\WalletAccount\WalletAccountController@StoreServiceMatrixConfig'
    ]);
    // api/walletaccount/GetWalletAccountDetails
    Route::get('/GetServiceMatrixConfig/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@GetServiceMatrixConfig'
    ]);
    // api/walletaccount/GetWalletBankAccount
    Route::get('/GetWalletBankAccount/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@GetWalletBankAccount'
    ]);
    // api/walletaccount/SearchWalletAccountNo
    Route::get('/SearchWalletAccountNo/{wand}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@SearchWalletAccountNo'
    ]);
    // api/walletaccount/UpdateServiceMatrixConfig
    Route::put('/UpdateServiceMatrixConfig/{essid}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@UpdateServiceMatrixConfig'
    ]);
    // api/walletaccount/SearchWalletJointAccount
    Route::get('/SearchWalletJointAccount/{wan}', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@SearchWalletJointAccount'
    ]);
    // api/walletaccount/ListOfWalletAccounts
    Route::get('/ListOfWalletAccounts', [
        'uses' => 'Api\\WalletAccount\WalletAccountController@ListOfWalletAccounts'
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
    'uses' => 'Api\\Account\AccountController@GetAccountViaEssId'
]);

// api/servicematrix/GenerateAccountNo
Route::get('/GenerateAccountNo', [
    'uses' => 'Api\\Account\AccountController@GenerateAccountNo'
]);


/***
* Services
*/ 
Route::prefix('service')->group(function(){ 

    Route::post('/createservice',[
        'uses' => 'Api\\Services\ServiceController@InsertService' 
    ]);
    Route::post('/updateservice',[
        'uses' => 'Api\\Services\ServiceController@UpdateService' 
    ]);
    
    Route::get('/getservicetype/{st_code}',[
        'uses' => 'Api\\Services\ServiceController@fillServiceType'
    ]); 
    
    Route::get('/getserviceslist',[
        'uses' => 'Api\\Services\ServiceController@GetService'
    ]); 
    
    Route::post('/createservice',[
        'uses' => 'Api\\Services\ServiceController@InsertService' 
    ]);  

    Route::post('/createjointservice',[
        'uses' => 'Api\\Services\ServiceController@InsertJointService' 
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

    Route::get('/getservicedetails/{service_id}',[
        'uses' => 'Api\\Services\ServiceController@GetServiceDetails'
    ]);

    Route::get('/getwalletdetails/{id}',[
        'uses' => 'Api\\Services\ServiceController@GetWalletDetails'
    ]);
    Route::get('/getvsdr/{service_id}',[
        'uses' => 'Api\\Services\ServiceController@GetVSDR'
    ]);
    Route::get('/getjointservicelist/{id}',[
        'uses' => 'Api\\Services\ServiceController@GetJointServicesList'
    ]);
    Route::get('/getservicetypecode/{id}/{wallet_condition}',[
        'uses' => 'Api\\Services\ServiceController@GetServiceTypeCode'
    ]);

    // api/service/listservices
    Route::get('/listservices', [
        'uses' => 'Api\\Services\ServiceController@ListServices'
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
        'uses' => 'Api\\ServiceType\ServiceTypeController@ShowServices'
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

    Route::post('/updateservicetype/templates',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@SaveServiceTemplates'
    ]);

    Route::get('/searchservicetype/{query}',[
        'uses' => 'Api\\ServiceType\ServiceTypeController@searchServiceType'
    ]);
});
    
    /**
    * Service Gateway
    */ 
Route::prefix('service_gateway')->group(function(){
    Route::post('/createservicegateway',[
        'uses' => 'Api\\ServiceGateway\ServiceGatewayController@CreateServiceGateway'
    ]);
    
    Route::get('/getservicegateway' ,[
        'uses' => 'Api\\ServiceGateway\ServiceGatewayController@GetServiceGateway'
    ]);
    
    Route::put('/updateservicegateway/{gw_id}',[
        'uses' => 'Api\\ServiceGateway\ServiceGatewayController@UpdateServiceGateway'
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


 // Gate
 Route::get('/auth-gate', [
    'uses' => 'Api\Gate\GateController@gate'
 ]);