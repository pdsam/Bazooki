<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionPhoto extends Model
{
    public $timestamps  = false;
    public $table = 'item_image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auction_id', 
        'image_path'
    ];

    public function auction() {
        return $this->belongsTo('App\Auction');
    }
}
