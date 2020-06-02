<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Moderator;
use App\Administrator;

class ModeratorController extends Controller
{

    public function getModerators() {
        $moderators = Moderator::whereNotExists(function($query) {
            $query->select(DB::raw(1))
                    ->from('administrator')
                    ->whereRaw('administrator.mod_id = moderator.id');
        })->get();
        return $moderators;
    }

    public function show()
    {
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        return view('dashboard.moderators', ['moderators' => $this->getModerators()]);
    }

    public function create(Request $request)
    {
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);

        }$validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|unique:moderator',
            'password' => 'required|string|max:100'
        ], $messages = [
            'email.unique' => 'Moderator with given email already exists',
            'email.email' => 'Invalid email format',
            'email.max' => 'Email is too big',
            'password.max' => 'Password is too big'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        Moderator::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return view('dashboard.moderators', ['moderators' => $this->getModerators()]);
    }

    public function delete(Request $request, Moderator $moderator)
    {
        if(!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'You do not have permission to access that resource.']);
        }

        $admin = Administrator::where('mod_id', $moderator->id)->get();
        if(count($admin) > 0) {
            return response()->json(['error' => 'Can not delete an administrator']);
        }
        
        Moderator::destroy($moderator->id);

        return response()->json(['success' => 'Successfully deleted moderator.']);
    }
}
