<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    //
    public $timestamps  = false;
    public $table = 'auction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner', 'base_bid', 'start_time', 'duration', 'insta_buy', 'item_name', 'item_description'
    ];
}
