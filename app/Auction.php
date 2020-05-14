<?php

namespace App;

use App\Bid;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    public $timestamps  = false;
    public $table = 'auction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
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
        return $this->hasOne('App\Bazooker.php');
    }

    public function certification() {
        return $this->belongsTo('App\Certification');
    }

    public function bids() {
        return $this->belongsToMany('App\Bid');
    }

    public function maxBid() {
        return Bid::where('auction_id', $this->id)->max('amount')->get();
    }

    //TODO categories
}
