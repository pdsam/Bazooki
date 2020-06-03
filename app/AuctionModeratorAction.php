<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionModeratorAction extends Model
{
    public $timestamps  = false;
    public $table = 'auction_moderator_action';

    protected $fillable = ['reason','active','action','mod_id','auction_id'];

    protected $dates = ['time_of_suspension'];

    public function mod(){
        return $this->belongsTo('App\Moderator');
    }

    public function auction(){
        return $this->belongsTo('App\Auction');
    }


    public function getDateFormat()
    {
        return 'Y-m-d H:i:sP';
    }
}
