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

Route::get('/', function () {
    if (Auth::guest()){
        return view('auth.login');  
    }
    else {
        return view('dashboard');
    }
    
});

/**
 * @ Magic Link For Auto Logged in 
 **/
Route::get('/autologin/{token}', function(Request $request, $token){
    // if (! $request->hasValidSignature()) {
    //     abort(403);
    // }
    // Check if Already Loggded In
    if(Auth::guest()){
        $user = DB::connection('mysql2')->table('users')->where('remember_token', '=', $token)->first();
        $check = DB::connection('mysql')->table('wallet_account')->where('ess_id', '=', $user->username)->first();
        if($check){
            Auth::loginUsingId($user->id);
            //return redirect('/');
            session(['user' => auth()->user()]);
            session(['username' => auth()->user()->username]);
            return view('layouts.app');
        }
        else{
            abort(404);
        }

    }
    else {
        abort(404);
    }


});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('{path}',"HomeController@index")->where('path','[-a-z0-9_\s]+');

Route::any('{all}', function () {
    return view('layouts.app');
})
->where(['all' => '.*']);