<?php

namespace App\Http\Controllers\Dashboard;

use App\Bazooker;
use App\Ban;
use App\Suspension;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    public function show()
    {
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        //$bazookers = Bazooker::all();
        $bazookers = Bazooker::where('status', '!=', 'banned')->get();

       // return dd($bazookers);

        return view('dashboard.users',['bazookers'=> $bazookers]);
    }

    public function suspend(Request $request,$id){
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        if(Auth::guard('mod')->check()){
            $modID = Auth::guard('mod')->user()->id;

        }
        if(Auth::guard('admin')->check()){
            $modID = Auth::guard('admin')->user()->mod->id;

        }

        $validator = Validator::make($request->all(), [
            'reason' =>'required|string|max:500',
            'bazooker_id' => 'required|numeric|gt',
            'duration' => 'required|numeric|gt'

        ],$messages = [
            'reason' =>'Reasons can have a max of 500 caracters',
            'bazooker_id' => 'Invalid bazooker_id',
            'duration' => 'Duration must be greater than 0'

        ]);

        if(is_null(Bazooker::find($id))){
            Redirect::back()->withErrors(["Can't suspend a bazooker that does not exist"]);
        }
        
        $suspension =  Suspension::create([
            'reason' => $request->reason,
            'mod_id' => $modID,
            'bazooker_id' => $id,
            'duration' => $request->duration


       ]);

        

        return Redirect::back();
    }

    public function unsuspend($id){

        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        $user = Bazooker::find($id);

        if(is_null($user)){
            Redirect::back()->withErrors(["Can't unsuspend a bazooker that does not exist"]);
        }

        $suspensions = $user->suspensions();

        foreach($suspensions as $suspension){
            $suspension->duration = 0;
            $suspension->save();

        }

        return Redirect::back();
    }

    public function ban($id){
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        if(Bazooker::find($id)->isBanned()){
            return Redirect::back()->withErrors(["User already banend"]);
        }

       // try{
       $ban =  Ban::create([
            'reason' => 'Please email us for that',
            'admin_id' => Auth::guard('admin')->user()->mod->id,
            'bazooker_id' => $id


       ]);
        //}
        //catch(Exception $e){
        //    return Redirect::back()->withErrors(["Something went wrong"]);
       // }


        return Redirect::back();
    }

}
