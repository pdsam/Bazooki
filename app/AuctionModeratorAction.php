<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionModeratorAction extends Model
{
    public $timestamps  = false;
    public $table = 'auction_moderator_action';


    protected $fillable = ['reason','activate','action','mod_id'];

    public function mod(){
        return $this->belongsTo('App\Moderator');
    }

    public function auction(){
        return $this->belongsTo('App\Auction');
    }


    
}
