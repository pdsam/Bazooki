<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
    
    public function create(Request $request) {
        if(!Auth::check()) {
            return redirect('auctions');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:2000',
            'short_description' => 'required|string|max:500',
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
            'item_short_description' => $request->short_description,
            'insta_buy' => $insta_buy
        ]);

        if(empty($newAuction)) return redirect('auctions');
/*
        if($request->photos)
        {
            $photos = $request->photos;
            foreach ($photos as $photo) {
                $path = $photo->store('auction_images'); //store image in storage/app/auction_images
                AuctionPhoto::create([
                    'auction_id' => $newAuction->id,
                    'image_path' => $path
                ]);
            }
        }*/

        // TODO certifications

        return redirect("auctions/$newAuction->id");
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
