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
            SELECT auction.item_name as title, image_path as img, auction.id as id, auction.item_short_description as description FROM 
                (SELECT auction_id, date_trunc('hour', time) as date_hour, MAX(date_trunc('hour', time) ) OVER (PARTITION BY auction_id) as max_date_hour, COUNT(amount) as num_bids FROM bid GROUP BY auction_id, date_hour)
                ignore
                JOIN auction
                ON auction_id=auction.id
                LEFT JOIN item_image
                ON ignore.auction_id = auction.id
                 WHERE date_hour=max_date_hour ORDER BY num_bids DESC LIMIT 8;
            ") );


    foreach ($hotdeals as &$value){
        $value = (array)$value;
        $value["img"] = "../assets/gun.jpg";
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
                    ) ignore
                WHERE end_time > now()
                ORDER BY time_left ASC LIMIT 8;
            ")

        );

        foreach ($flashdeals as &$value){
            $value = (array)$value;
            $value["img"] = "../assets/gun.jpg";
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


    public function deals(){

    $main = array(
        0 => array(
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                        "id" => 1,
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                        "id" => 1,
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                        "id" => 1,
                "description" => "This gun is very strong. It is also very pretty."
            )
        ),
        1 => array(
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                        "id" => 1,
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                        "id" => 1,
                "description" => "This gun is very strong. It is also very pretty."
            ),
            array(
                "title" => "Super cool gun",
                "img" => "../assets/gun.jpg",
                        "id" => 1,
                "description" => "This gun is very strong. It is also very pretty."
            )
        )        
    );
    return view('pages.auctions',
        [
            'main'=>$main,
            'hotdeals'=>$this->hotdeals(),
            'flash'=>$this->flashdeals()
        ]
    );

    }
}
