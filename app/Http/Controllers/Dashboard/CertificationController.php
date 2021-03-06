<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Certification;
use App\Auction;
use App\Bazooker;
use App\AuctionPhoto;

class CertificationController extends Controller
{
    public function show()
    {
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return Redirect::back()->withErrors(['You do not have permission to access that resource.', '┬┴┬┴┤ ͜ʖ ͡°) ├┬┴┬┴']);
        }

        $auctions = Auction::whereRaw('start_time + duration * interval \'1 second\' > CURRENT_TIMESTAMP')
            ->whereHas('certification', function(Builder $query) {
                    $query->where('status', 'pending');
                })
            ->get(['id', 'owner', 'item_name', 'item_short_description']);
        
        foreach($auctions as $auction) {
            $certification = $auction->certification()->get()[0];
            $auction["certification_id"] = $certification["id"];
            $auction["certification_path"] = str_replace("public", "storage", $certification["certification_doc_path"]);
            
            $owner = $auction->owner;
            $auction["owner_name"] = Bazooker::where('id', $owner)->get()[0]["username"];

            $auction_photos = AuctionPhoto::where('auction_id', $auction->id)->get();
            $auction["photo"] = count($auction_photos) ? 
                                    str_replace("public", "storage", $auction_photos[0]["image_path"]) : 
                                    "assets/unknown_item.png";
        }

        return view('dashboard.certifications', ["auctions" => $auctions]);
    }

    public function updateStatus(Request $request, Certification $certification) {
        if(!Auth::guard('mod')->check() && !Auth::guard('admin')->check()) {
            return response()->json(['error' => 'You do not have permission to access that resource.']);
        }

        $newStatus = $request->input('certificationStatus');
        if($newStatus != 'accepted' && $newStatus != 'rejected') {
            return response()->json(['error' => 'Invalid certification status.']);
        }

        $certification->status = $newStatus;
        $certification->save();

        return response()->json(['success' => 'Successfully updated certification status.']);
    }
}
