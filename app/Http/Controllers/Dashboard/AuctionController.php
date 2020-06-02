<?php

namespace App\Http\Controllers\Dashboard;

use App\Auction;
use App\AuctionModeratorAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Exception;


class AuctionController extends Controller
{
    public function show()
    {
        /*
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }
        */
        $auctions = Auction::whereRaw('start_time + duration * interval \'1 second\' > CURRENT_TIMESTAMP')->where('status', '!=', 'removed');
        //return dd($auctions->get());
        $auctions = $auctions->get();
        return view('dashboard.auctions',['auctions' =>$auctions]);
    }

    public function freeze($id){
         
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }
        

        if(Auth::guard('mod')->check()){
            $modID = Auth::guard('mod')->user()->id;

        }
        if(Auth::guard('admin')->check()){
            $modID = Auth::guard('admin')->user()->mod->id;

        }

        $auction = Auction::find($id);
        if($auction->isFrozen()){
            return  Redirect::back()->withErrors(["Can't freeze what's already frozen"]);
        }


        //try{
        $action = AuctionModeratorAction::create([
            'reason' => 'Please email us for that',
            'active' => true,
            'action' => 'freezed',
            'mod_id' => $modID,
            'auction_id' => $id

        ]);
       // }
        //catch(Exception $e){
        //  return  Redirect::back()->withErrors(['Error in db: (╯°□°）╯︵ ┻━┻']);
        //}

       
        
        
        return Redirect::back();
    }

    public function unfreeze($id){
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        
        $auction = Auction::find($id);
        $action = $auction->getFreezingAction()[0];
        
        if(is_null($action)){
            return  Redirect::back()->withErrors(["Can't unfreeze what's not frozen"]);
        }
        
        $action->active = false;
        $action->save();


        return Redirect::back();

    }

    public function delete($id){

         
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }
        

        if(Auth::guard('mod')->check()){
            $modID = Auth::guard('mod')->user()->id;

        }
        if(Auth::guard('admin')->check()){
            $modID = Auth::guard('admin')->user()->mod->id;

        }
        
        $auction = Auction::find($id);
        $freezing = $auction->getFreezingAction();
        if(!($freezing->isEmpty())){
            $freezing = $freezing[0];
            $freezing->active = false;
            $freezing->save();
        }

            
        //try{
        $action = AuctionModeratorAction::create([
            'reason' => 'Please email us for that',
            'active' => true,
            'action' => 'removed',
            'mod_id' => $modID,
            'auction_id' => $id

        ]);
        //}
       // catch(Exception $e){
       //   return  Redirect::back()->withErrors(['Error in db: Already Removed (╯°□°）╯︵ ┻━┻']);
       // }

       
        
        
        return Redirect::back();
    }

}
