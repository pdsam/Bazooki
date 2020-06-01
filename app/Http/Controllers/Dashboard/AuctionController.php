<?php

namespace App\Http\Controllers\Dashboard;

use App\Auction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuctionController extends Controller
{
    public function show()
    {
        /*
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }
        */
        $auctions = Auction::whereRaw('start_time + duration * interval \'1 second\' > CURRENT_TIMESTAMP');
        $auctions = $auctions->get();
        return view('dashboard.auctions',['auctions' =>$auctions]);
    }

    public function freeze($id){
         /*
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }
        */

        $auction = Auction::find($id);
        $actions = $auction->moderatorActions();



        return $actions->get();
        //return redirect('mod/auctions');
    }

    public function unfreeze($id){

    }

    public function delete($id){

         /*
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }
        */

        return redirect('mod/auctions');
    }

}
