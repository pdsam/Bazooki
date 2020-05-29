<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';

    protected $fillable = [
        'auction_id',
        'bidder_id',
        'amount',
        
    ];

    public function bidder() {
        return $this->belongsTo('App\Bazooker');
    }

    

    public function auction() {
        return $this->belongsTo('App\Auction');
    }
}
