<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class IndexController extends Controller
{
    public function show()
    {
        if (!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            $referer = Request::header('referer');
            if (empty($referer)) {
                return Redirect::to(route('auctions'));
            } else {
                return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
            }
        }

        return view('dashboard.main');
    }
}
