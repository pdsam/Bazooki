<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';

    public function bidder() {
        return $this->belongsTo('App\Bazooker');
    }

    public function auction() {
        return $this->belongsTo('App\Auction');
    }
}
