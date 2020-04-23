<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchesOldPassword;
use App\Bazooker;

class ChangePasswordController extends Controller
{

    public function __construct() {
        
    }

    public function __invoke(Request $request) {
        $validator = Validator::make($request->all(), [
            'oldPass' => ['required', new MatchesOldPassword],
            'newPass' => 'required|string|min:6',
            'confirmPass' => 'same:newPass'
        ], [
            'newPass.min' => 'The new password must have at least :min characters.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('settings')
                ->withErrors($validator, 'pass_change');
        }

        Bazooker::find(Auth::user()->id)->update(['password' => Hash::make($request->newPass)]);
        return redirect()->route('settings');
    }
}
