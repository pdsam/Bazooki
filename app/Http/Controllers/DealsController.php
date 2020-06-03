<?php
namespace App\Http\Controllers;

use App\Auction;
use App\AuctionModeratorAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Exception;


class DealsController extends Controller
{
    public function hotdeals(){

        $hotdeals = DB::select( DB::raw("
		SELECT    auction.item_name              AS title, 
          image_path                     AS img, 
          auction.id                     AS id, 
          auction.item_short_description AS description 
FROM      ( 
                   SELECT   auction_id, 
                            Count(amount) AS num_bids 
                   FROM     ( 
                                   SELECT auction_id, 
                                          Date_trunc('hour', TIME)                                      AS date_hour,
                                          Max(Date_trunc('hour', TIME) ) over (PARTITION BY auction_id) AS max_date_hour,
                                          amount 
                                   FROM   bid) not_considered 
                   WHERE    max_date_hour=date_hour 
                   GROUP BY auction_id) ignore 
join      auction 
ON        auction_id=auction.id 
left join item_image 
ON        item_image.auction_id = auction.id 
WHERE     auction.status='live'
AND       start_time < Now() 
ORDER BY  num_bids DESC limit 8;
		
            ") );


    foreach ($hotdeals as &$value){
        $value = (array)$value;
    if(is_null($value["img"]))
	    $value["img"] = "../assets/gun.jpg";
    else
	    $value['img'] = str_replace("public", "storage", $value['img']);
    }
    
    $numDeals = count($hotdeals)/4 + (count($hotdeals)%4 != 0 ? 1 : 0);
    $hotdeals_gil = array();

    for($i = 0; $i < $numDeals; $i = $i + 1)
        array_push($hotdeals_gil, array());
    

    for($i = 0; $i < count($hotdeals); $i = $i +1){
        array_push($hotdeals_gil[$i/4], $hotdeals[$i]);
    }

    return $hotdeals_gil;
    }

    public function flashdeals(){

        $flashdeals = DB::select(

            DB::raw("
                SELECT title, img,  id,  description
                FROM
                    (
                    SELECT item_name as title, image_path as img, auction.id as id, item_short_description as description, start_time, duration, start_time+make_interval(secs := duration) as end_time, now()-start_time+make_interval(secs := duration) as time_left
                    FROM auction
                    LEFT JOIN item_image
                    ON auction_id=auction.id
                    WHERE auction.status = 'live'
                    ) ignore
                WHERE end_time > now()
		AND start_time < now()
                ORDER BY time_left ASC LIMIT 8;
            ")

        );

        foreach ($flashdeals as &$value){
            $value = (array)$value;
	    if(is_null($value["img"]))
		    $value["img"] = "../assets/gun.jpg";
	    else
		    $value['img'] = str_replace("public", "storage", $value['img']);
        }
        
        $numDeals = count($flashdeals)/4 + (count($flashdeals)%4 != 0 ? 1 : 0);
        $flashdeals_gil = array();

        for($i = 0; $i < $numDeals; $i = $i + 1)
            array_push($flashdeals_gil, array());
        

        for($i = 0; $i < count($flashdeals); $i = $i +1){
            array_push($flashdeals_gil[$i/4], $flashdeals[$i]);
        }

        return $flashdeals_gil;

    }

    private function latest(){
        $latestdeals = DB::select(

            DB::raw("
            SELECT item_name as title, image_path as img, auction.id as id, item_short_description as description
                FROM auction LEFT JOIN item_image
		ON 
		auction_id=auction.id
		WHERE status='live'
		AND start_time < now()
		 ORDER BY start_time DESC LIMIT 8;
            ")

        );

        foreach ($latestdeals as &$value){
            $value = (array)$value;
	    if(is_null($value["img"]))
		    $value["img"] = "../assets/gun.jpg";
	    else
		    $value['img'] = str_replace("public", "storage", $value['img']);
		    
        }

        
        $numDeals = count($latestdeals)/4 + (count($latestdeals)%4 != 0 ? 1 : 0);
        $latestdeals_gil = array();

        for($i = 0; $i < $numDeals; $i = $i + 1)
            array_push($latestdeals_gil, array());

        
        for($i = 0; $i < count($latestdeals); $i = $i +1){
            array_push($latestdeals_gil[$i/4], $latestdeals[$i]);
        }

        return $latestdeals_gil;
    }

    public function deals(){

    return view('pages.auctions',
        [
	    'main'=>$this->latest(),
            'hotdeals'=>$this->hotdeals(),
            'flash'=>$this->flashdeals()
        ]
    );

    }
}
