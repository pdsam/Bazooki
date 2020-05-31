<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     /**
     * Show the form to create a new auction
     *
     * @return View
     */
    public function mainPage()
    {
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return redirect('auctions');
        }

        return view('dashboard.main');
    }
}
