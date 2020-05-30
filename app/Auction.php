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

    public function moderatorActions() {
        return $this->hasMany('App\AuctionModeratorAction');
    }

    public function hasModAction() {
        $action = $this->moderatorActions()->where('activate', '=', 'true')->get();
        return !is_null($action);
    }

    public function currentPrice() {
        $maxBid = $this->bids->max('amount');
        if (is_null($maxBid)) {
            return $this->base_bid;
        }
        return $maxBid;
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'auction_category', 'auction_id', 'cat_id');
    }

    public function endTime() {
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time)->modify("+$this->duration seconds");
    }

    public function isOver() {
        return $this->endTime() < new DateTime();
    }
}
