<?php

namespace App;

use App\Bid;
use DateTime;
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
        return $this->moderatorActions()->where('activate', '=', 'true')->exists();
    }

    public function currentPrice() {
        $maxBid = $this->bids()->max('amount');
        if (is_null($maxBid)) {
            return $this->base_bid;
        }
        return $maxBid;
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
}
