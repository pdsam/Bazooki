<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Auction;

class AuctionController extends Controller
{
     /**
     * Show the form to create a new auction
     *
     * @return View
     */
    public function createForm()
    {
        if(!Auth::check()) {
            return redirect('auctions');
        }

        return view('pages.create_auction');
    }
    public function show($id = null)
    {
        if($id = null){
            return redirect('auctions');
        }
        $auction = Auction::find($id);
        
        if ($auction == null) {
            return redirect('auctions');
        }

        return view('pages.auctionPage',['id'=>$id]);

    }
}
