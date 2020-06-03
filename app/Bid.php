<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';
    public $timestamps = false;

    protected $fillable = [
        'auction_id',
        'bidder_id',
        'amount',
        'time'
    ];

    protected $dates = [
        'time'
    ];

    public function bidder() {
        return $this->belongsTo('App\Bazooker');
    }

    public function auction() {
        return $this->belongsTo('App\Auction');
    }
}
