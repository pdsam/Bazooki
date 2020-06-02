<?php

namespace App\Http\Controllers\Dashboard;

use App\Bazooker;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function show()
    {
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        $bazookers = Bazooker::all();

        return view('dashboard.users',['bazookers'=> $bazookers]);
    }

    public function suspend($id){
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        return Redirect::back()->withErrors(["WIP SUSPEND"]);
    }

    public function ban($id){
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }


        return Redirect::back()->withErrors(["WIP BAN"]);
    }

}
