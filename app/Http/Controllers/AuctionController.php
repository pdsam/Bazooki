<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Bazooker;

class AuctionController extends Controller
{

    private $dbTable = 'auction';

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
    
    public function create(Request $request) {
        if(!Auth::check()) {
            return redirect('auctions');
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required|string|max:100'],
            'description' => ['required|string|max:2000'],
            'base_bid' => ['required|numeric|gte:0'],
            'start_time' => ['required|date'],
            'duration' => ['required|numeric|gt:0'],
            'photos' => ['nullable|array'],
            'insta_buy' => ['nullable|numeric|gt:0']
        ]);

        if ($validator->fails()) {
            return redirect('auctions');
        }

        $validator->validate();

        $userID = Auth::user()->id;
        $newAuction = Auction::create([
            'owner' => $userID,
            'base_bid' => $request->base_bid,
            'start_time' => $request->start_time,
            'duration' => $request->duration,
            'item_name' => $request->name,
            'item_description' => $request->description
        ]);

        if(empty($newAuction)) return redirect('auctions');
        
        if($request->has('photos'))
            $newAuction->photos = $request->photos;
        if($request->has('insta_buy'))
            $newAuction->insta_buy = $request->insta_buy;
        $newAuction->save();

        return redirect("auctions/$newAuctionID");
    }
}
?>
