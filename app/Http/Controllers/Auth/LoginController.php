<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
    * Override the username method used to validate login
    *Custom For Username Login
    * @return string
    */
    public function username()
    {
        return 'username';
    }
    protected function credentials(\Illuminate\Http\Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'AccountStatus' => 1];
    }
    /**
     * Authenticate the Expire User or Account the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function authenticated(\Illuminate\Http\Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];
        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        $updated_at = $user->updated_at;
        $expiry_date = $user->expiry_date;
        $CheckExpirationDate = Carbon::parse($user->expiry_date);
        $account_expiry_at = Carbon::parse($updated_at)->addDays($expiry_date);
        if($CheckExpirationDate->isPast()){
            // Check if the user is not yet Verified
            if($user->expiry_date && $user->user_type_id != "1") {
                $errors = [$this->username() => trans('auth.expired')];
                auth()->logout();
                //return redirect('login')->withErrors($errors);
                return response()->json([
                    'message' => 'These credemtials do not match our records.'
                ]);
            }
        }
        /**
         * @ Security For Case Sensitive Credentials
         *  */
        elseif($user->username !== $request->{$this->username()}){
                $errors = [$this->username() => trans('auth.failed')];
                auth()->logout();
                //return redirect('login')->withErrors($errors);
                return response()->json([
                    'message' => 'These credentials do not match our records.'
                ]);
        }

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
