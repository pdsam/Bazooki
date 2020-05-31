<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionCategory extends Model
{
    public $timestamps  = false;
    public $table = 'auction_category';

    protected $fillable = [
        'auction_id', 
        'cat_id'
    ];
}
