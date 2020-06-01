<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ModeratorController extends Controller
{
    public function show()
    {
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        return view('dashboard.moderators');
    }
}
