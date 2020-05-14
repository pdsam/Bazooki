<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bid';

    public function bidder() {
        return $this->hasOne('App\Bazooker');
    }

    public function auction() {
        return $this->hasOne('App\Auction');
    }
}
