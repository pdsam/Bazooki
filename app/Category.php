<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps  = false;
    public $table = 'category';

    protected $fillable = [
        'name'
    ];

    public function auctions() {
        return $this->belongsToMany(Auction::class, 'auction_category', 'cat_id', 'auction_id');
    }
}
