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

class UserController extends Controller
{
    public function show()
    {
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }
        $bazookers = Bazooker::where('status', '!=', 'banned')->get();

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
            'duration' => 'required|numeric|gt:0|max:30'
        ],$messages = [
            'reason' =>'Reasons can have a max of 500 caracters',
            'bazooker_id' => 'Invalid bazooker_id',
            'duration.gt' => 'Duration must be greater than 0',
            'duration.max' => 'Suspention must not exceed 30 days'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if(is_null(Bazooker::find($id))){
            Redirect::back()->withErrors(["Can't suspend a bazooker that does not exist"]);
        }
        
        $suspension =  Suspension::create([
            'reason' => $request->reason,
            'mod_id' => $modID,
            'bazooker_id' => $id,
            'duration' => $request->duration * 3600 * 24
       ]);

        return Redirect::back()->with('successMsg', 'Successfully suspended user');
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

        return Redirect::back()->with('successMsg', 'Successfully unsuspended user');
    }

    public function ban(Request $request,$id){
        if(!Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        $validator = Validator::make($request->all(), [
            'reason' =>'required|string|max:500',
            'duration' => 'required|numeric|gt:0'
        ],$messages = [
            'reason' =>'Reasons can have a max of 500 caracters',
            'duration' => 'Duration must be greater than 0',
            
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        if(is_null(Bazooker::find($id))){
            Redirect::back()->withErrors(["Can't ban a bazooker that does not exist"]);
        }

        if(Bazooker::find($id)->isBanned()){
            return Redirect::back()->withErrors(["Stop, he is already banned..."]);
        }

       $ban = Ban::create([
            'reason' => $request->reason,
            'admin_id' => Auth::guard('admin')->user()->mod->id,
            'bazooker_id' => $id
       ]);

        return Redirect::back()->with('successMsg', 'Successfully banned user');
    }

}
