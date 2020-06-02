<?php

namespace App;

use App\Bid;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Log;

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
        'status',
        'insta_buy', 
        'item_name', 
        'item_description', 
        'item_short_description'
    ];

    protected $dates = [
        'start_time',
    ];

    public function photos() {
        return $this->hasMany('App\AuctionPhoto');
    }

    public function owner() {
        return $this->belongsTo('App\Bazooker');
    }

    public function certification() {
        return $this->hasOne('App\Certification');
    }

    public function bids() {
        return $this->hasMany('App\Bid');
    }

    public function moderatorActions() {
        return $this->hasMany('App\AuctionModeratorAction');
    }

    public function hasModAction() {
        return $this->moderatorActions()->where('active', '=', 'true')->exists();
    }

    public function currentPrice() {
        $maxBid = $this->current_price;
        if (is_null($maxBid)) {
            return $this->base_bid;
        }
        return $maxBid;
    }

    public function highestBidder() {
        return $this->belongsTo('App\Bazooker', 'highest_bidder');
    }

    public function transaction() {
        return $this->hasOne('App\AuctionTransaction', 'auction_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'auction_category', 'auction_id', 'cat_id');
    }

    public function endDateTime() {
        return $this->start_time->modify("+$this->duration seconds");
    }

    public function isOver() {
        return $this->endDateTime() < new DateTime('now');
    }

    public function hasStarted() {
        return $this->start_time <= new DateTime('now');
    }

    public function isFrozen(){
        return $this->moderatorActions()
            ->where('action', '=', 'freezed')
            ->Where('active', '=', true)
            ->exists();
    }

    public function getFreezingAction(){
        return $this->moderatorActions()
            ->where('action', '=', 'freezed')
            ->Where('active', '=', true)->get();
    }
}
