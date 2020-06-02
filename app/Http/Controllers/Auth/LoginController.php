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
        $this->middleware('guest:bazooker')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:mod')->except('logout');
    }

    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $remember = !is_null($request->input('remember-me'));

        if (Auth::guard('admin')->attempt(['email' => $username, 'password'=>$password], $remember)) {
            return redirect()->route('dashboard')->with('successMsg', 'Welcome back :)');
        }
        if (Auth::guard('mod')->attempt(['email' => $username, 'password'=>$password])) {
            return redirect()->route('dashboard')->with('successMsg', 'Welcome back :)');
        }
        if (Auth::guard('bazooker')->attempt(['username' => $username, 'password'=>$password])) {
            return redirect()->route('profile')->with('successMsg', 'Welcome back :)');
        }

        return redirect()->route('login')
            ->with('invalidUsername', 1)
            ->withInput(['username' => $username]);
    }
}
