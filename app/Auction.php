<?php

namespace App;

use App\Bid;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    public $timestamps  = false;
    public $table = 'auction';

    /**
     * 
     */
    protected $fillable = [
        'owner', 
        'base_bid', 
        'start_time', 
        'duration', 
        'insta_buy', 
        'item_name', 
        'item_description', 
        'item_short_description'
    ];

    public function photos() {
        return $this->hasMany('App\AuctionPhoto');
    }

    public function owner() {
        return $this->belongsTo('App\Bazooker.php');
    }

    public function certification() {
        return $this->hasOne('App\Certification');
    }

    public function bids() {
        return $this->hasMany('App\Bid');
    }

    public function maxBid() {
        $maxBid = $this->bids->max('amount');
        if (is_null($maxBid)) {
            return $this->base_bid;
        }
        return $maxBid;
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'auction_category', 'auction_id', 'cat_id');
    }
}
