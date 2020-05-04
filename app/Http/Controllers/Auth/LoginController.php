<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:bazooker')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:mod')->except('logout');
    }

    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;

        if (Auth::guard('admin')->attempt(['email' => $username, 'password'=>$password])) {
            return response('administrator');
        }
        if (Auth::guard('mod')->attempt(['email' => $username, 'password'=>$password])) {
            return response('moderator');
        }
        if (Auth::guard('bazooker')->attempt(['username' => $username, 'password'=>$password])) {
            return redirect()->route('profile');
        }

        return redirect()->route('login')
                         ->withErrors([ 'username' => '1', ]);
    }
}
