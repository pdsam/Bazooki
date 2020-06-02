<?php

namespace App\Http\Controllers\Dashboard;

use App\Bazooker;
use App\Ban;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Exception;

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

        if(Auth::guard('mod')->check()){
            $modID = Auth::guard('mod')->user()->id;

        }
        if(Auth::guard('admin')->check()){
            $modID = Auth::guard('admin')->user()->mod->id;

        }

        return Redirect::back()->withErrors(["WIP SUSPEND"]);
    }

    public function ban($id){
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        try{
       $ban =  Ban::create([
            'reason' => 'Please email us for that',
            'admin_id' => Auth::guard('admin')->user()->mod->id,
            'bazooker_id' => $id


       ]);
        }
        catch(Exception $e){
            return Redirect::back()->withErrors(["User already banend"]);
        }


        return Redirect::back()->withErrors(["WIP BAN"]);
    }

}
