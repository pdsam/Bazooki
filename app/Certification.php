<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    public $timestamps  = false;
    protected $table = 'certification';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'auction_id', 
        'certification_doc_path'        
    ];

    public function auction() {
        return $this->belongsTo('App\Auction');
    }
}
