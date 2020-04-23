<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Auction;

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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:2000',
            'short_description' => 'required|string|max:1000',
            'base_bid' => 'required|numeric|gte:0',
            'start_time' => 'required|date_format:d-m-Y',
            'duration' => 'required|numeric|gt:0',
            'photos' => 'nullable|array',
            'insta_buy' => 'nullable|numeric|gt:0'
        ]);

        if ($validator->fails()) {
            return redirect('auctions');
        }

        $userID = Auth::user()->id;
        $startDate = date('Y-m-d', strtotime($request->start_time));
        $insta_buy = null;
        if ($request->has('insta_buy'))
            $insta_buy = $request->insta_buy;
        $newAuction = Auction::create([
            'owner' => $userID,
            'base_bid' => $request->base_bid,
            'start_time' => $startDate,
            'duration' => $request->duration,
            'item_name' => $request->name,
            'item_description' => $request->description,
            'insta_buy' => $insta_buy
        ]);

        if(empty($newAuction)) return redirect('profile');

        if($request->has('photos')) {
            // TODO save photos
        }

        // TODO certifications and short description!

        return redirect("auctions/$newAuction->id");
    }
}
?>
