<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Auction;
use App\AuctionPhoto;
use App\Certification;

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
            'photos.*' => 'mimes:png,jpg,jpeg,bmp,tiff |max:10240',
            'insta_buy' => 'nullable|numeric|gt:0',
            'certification' => 'nullable|mimes:pdf |max:4096'
        ], $messages = [
            'name.max' => 'Name has a maximum of 100 characters',
            'description.max' => 'Name has a maximum of 2000 characters',
            'short_description.max' => 'Name has a maximum of 500 characters',
            'base_bid.gte' => "Base bid must be greater than or equal to 0",
            'start_time.date_format' => "Invalid date format, must be d-m-Y",
            'duration.gt' => "Duration must be greater than 0",
            'insta_buy.gt' => "Instant buy price must be greater than 0",
            'photos.*.mimes' => 'Photos must be of image format',
            'photos.*.max' => 'Photos must be less than 10 MB',
            'certification.mimes' => 'Certification must be a PDF',
            'certification.max' => 'Certification should be less than 4 MB'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $userID = Auth::user()->id;
        $startDate = date('Y-m-d', strtotime($request->start_time));
        $insta_buy = null;
        if ($request->has('insta_buy')) {
            $insta_buy = $request->insta_buy;
        }
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

        if($request->hasFile('photos')) {
            $files = $request->file('photos');
            foreach($files as $file){
                $filename = $file->store('public/auction_images'); //store image in storage/app/public/auction_images
                AuctionPhoto::create([
                    'auction_id' => $newAuction->id,
                    'image_path' => $filename
                ]);

            }
        }

        if($request->hasFile('certification')) {
            $certification = $request->file('certification');
            $filename = $certification->store('certifications');
            $newCert = Certification::create([
                'auction_id' => $newAuction->id,
                'certification_doc_path' => $filename
            ]);
        }

        return redirect("auctions/$newAuction->id");
    }
    public function show($id = null)
    {
        if($id == null){
            return redirect('auctions');
        }
        $auction = Auction::find($id);
        
        if ($auction == null) {
            return redirect('auctions');
        }
        
        $auction_photos = $auction->photos()->get();
        $photo_paths = array();
        foreach($auction_photos as $photo) {
            $path = str_replace("public", "storage", $photo->image_path);
            array_push($photo_paths, $path);
        }

        if (count($photo_paths) == 0) {
            $photo_paths = array("assets/unknown_item.png");
        }

        return view('pages.auctionPage',[
            'id' => $auction->id,
            'name'=>$auction->item_name,
            'base_bid'=>$auction->base_bid,
            'description'=>$auction->item_description,
            'duration'=>$auction->duration,
            'start_time'=>$auction->start_time,
            'photos'=>$photo_paths
        ]);

    }

    public function bid(Request $request, $id) {
        return response($request->input('amount'));
    }

    public function query(Request $request) {
        $filters = $request->only(['auction_name', 'categories', 'max_bid']);

        $auctionsQuery = null;
        if (isset($filters['auction_name']) && !empty($filters['auction_name'])) {
            $auctionsQuery = Auction::whereRaw('"search" @@ plainto_tsquery(\'english\', ?)', ['\''.$filters['auction_name'].'\'']);
        }

        $auctions = null;
        if ($auctionsQuery == null) {
            $auctions = Auction::all();
        } else {
            $auctions = $auctionsQuery->get();
        }
        return view('pages.query', [
            'filters'=>$filters,
            'auctions'=>$auctions
        ]);
    }
}
