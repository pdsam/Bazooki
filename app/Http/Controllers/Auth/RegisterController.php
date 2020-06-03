<?php

namespace App\Http\Controllers\Auth;

use App\Bazooker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:bazooker');
        $this->middleware('guest:admin');
        $this->middleware('guest:mod');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:bazooker|unique:moderator,email',
            'email' => 'required|string|email|unique:bazooker|unique:moderator',
            'password' => 'required|string|min:6',
            'accepted' => 'accepted'
        ], [
            'name.max' => 'Name is too long (max. 255 characters)',
            'username.max' => 'Username is too long (max. 255 characters)',
            'username.unique' => 'Username already in use',
            'email.unique'=>'Email already in use',
            'email.email'=>'Please enter a valid email',
            'password.min' => 'Password is too short (min. 6 characters)',
            'accepted.accepted' => 'You must accept the Terms and Conditions'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Bazooker::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function createModerator(Request $request) {

    }

    public function createAdministrator(Request $request) {

    }

}
