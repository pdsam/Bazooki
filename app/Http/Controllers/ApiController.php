<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function auction_bids($id = null)
    {
	    $res = DB::table('bid')->where('auction_id', '=', $id)
		    ->join('bazooker', 'bid.bidder_id', '=', 'bazooker.id')
		    ->select('bid.*', 'bazooker.username')
		    ->get();
	    return json_encode($res);
    }

    public function bidder_review($id = null){
	    $res = DB::table('feedback')->where('rater_id', '=', $id)
		    ->select('id', 'rated_id', 'auction', 'rating')
		    ->get();
	    return $res;
    }

    public function auctioneer_review($id = null){
	    $res = DB::table('feedback')->where('rated_id', '=', $id)
		    ->select('id', 'rater_id', 'auction', 'rating')
		    ->get();
	    return $res;
    }

    public function bazooker_rating($id = null){
	    $res = DB::table('feedback')->where('rated_id', '=', $id)
		    ->groupBy('rated_id')
		    ->select(DB::raw('COUNT(*) as cnt, AVG(rating) as rating'))
		    ->get();
	    return $res;
    }

    public function sales(){
	    return response()->json([
			'date' => '2020-04-23 13:19',
			    'value' => 5000
		    ]);
    }

    public function auctions(){
	    return "[
        {
            'id': 1,
            'image': '/path/to/image',
            'title': 'Enma',
            'starttime': '2020-04-7 06:12:12',
            'duration': 2592000,            
            'description': 'One of Kozaburo's masterpieces, also one of the 21 O Wazamono.',
            'insta_buy': 300000,
            'highest_bid': 150000,
            'categories' : [
                'swords',
                '21 O Wazamono'                
            ]
        },
        {
            'id': 2,
            'image': '/path/to/image',
            'title': 'Sandai Kitetsu',
            'starttime': '2020-04-7 06:12:12',
            'duration': 2592000,  
            'description': 'The third of the Kitetsu Swords crafted by Tenguyama Hitetsu.',
            'insta_buy': 300000,
            'highest_bid': 10000,
            'categories' : [
                'swords',
                'Kitetsu Swords'                
            ]   
        }         
    ]  
";
    }
}
?>
