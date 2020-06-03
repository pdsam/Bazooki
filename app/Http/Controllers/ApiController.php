<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Feedback;
use App\AuctionTransaction;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function auction_bids($id = null)
    {
        if(!ctype_digit($id)){
            return json_encode(array("error" => "id must be an integer"));
        }
	    $res = DB::table('bid')->where('auction_id', '=', $id)
		    ->join('bazooker', 'bid.bidder_id', '=', 'bazooker.id')
		    ->select('bid.*', 'bazooker.username')
		    ->get();
	    return json_encode($res);
    }

    public function bidder_review($id = null){
        if(!ctype_digit($id)){
            return json_encode(array("error" => "id must be an integer"));
        }
	    $res = Feedback::where('rater_id', '=', $id)
		    ->select('id', 'rated_id', 'auction', 'rating')
		    ->get();
	    return $res;
    }

    public function auctioneer_review($id = null){
        if(!ctype_digit($id)){
            return json_encode(array("error" => "id must be an integer"));
        }
	    $res = Feedback::where('rated_id', '=', $id)
		    ->select('id', 'rater_id', 'auction', 'rating')
		    ->get();
	    return $res;
    }

    public function bazooker_rating($id = null){
        if(!ctype_digit($id)){
            return json_encode(array("error" => "id must be an integer"));
        }
	    $res = Feedback::where('rated_id', '=', $id)
		    ->select(DB::raw('COUNT(*) as cnt, AVG(rating) as rating'))
		    ->groupBy('rated_id')
		    ->get();
	    return $res;
    }

    public function sales(){

        return AuctionTransaction::whereRaw("date >= now()-interval '1 day'")
            ->groupBy(DB::raw("date_trunc('hour', date)"))
            ->select(DB::raw("date_trunc('hour', date) as hour, SUM(value) as value"))
	    ->orderBy("hour")
            ->get();
    }
}
?>
