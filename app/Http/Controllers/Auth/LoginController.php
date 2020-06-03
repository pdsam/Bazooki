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
            $user = Auth::guard('bazooker')->user();
            if (strcmp($user->status, 'deleted') == 0) {
                Auth::logout();
                return back()->withErrors(['problem'=>'Invalid username or password.']);
            }
            if ($user->isBanned()) {
                Auth::logout();
                return back()->withErrors([
                    'banned' => 'This account was banned.'
                ]);
            }
            if ($user->isSuspended()) {
                $suspended = $user->suspensions()->whenRaw('time_of_suspension + duration * interval \'1 second\' > CURRENT_TIMESTAMP')->get()[0];
                $seconds = $suspended->duration;
                $time = $suspended->time_of_suspension->modify("+$seconds seconds");

                Auth::logout();
                return back()->withErrors([
                    'suspended' => "This account is suspended until $time."
                ]);
            }
            return redirect('profile/'.$user->id)->with('successMsg', 'Welcome back :)');
        }

        return redirect()->route('login')
            ->with('invalidUsername', 1)
            ->withInput(['username' => $username]);
    }
}
