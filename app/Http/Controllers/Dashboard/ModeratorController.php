<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Moderator;
use App\Administrator;

class ModeratorController extends Controller
{
    public function show()
    {
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        $moderators = Moderator::whereNotExists(function($query) {
            $query->select(DB::raw(1))
                    ->from('administrator')
                    ->whereRaw('administrator.mod_id = moderator.id');
        })->get();

        return view('dashboard.moderators', ['moderators' => $moderators]);
    }

    public function create(Request $request)
    {
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        return view('dashboard.moderators');
    }

    public function delete()
    {
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        return view('dashboard.moderators');
    }
}
