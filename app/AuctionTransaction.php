<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionTransaction extends Model
{
    public $timestamps = false;
	protected $table = 'auction_transaction';

	protected $fillable = [
	    'sender',
        'receiver'
    ];

	public function senderBaz() {
	    return $this->belongsTo('App\Bazooker', 'sender');
    }

    public function receiverBaz() {
        return $this->belongsTo('App\Bazooker', 'receiver');
    }

    public function auction() {
	    return $this->belongsTo('App\Auction', 'auction_id');
    }

	public function auctioneerReview() {
	    return $this->hasOne('App\Feedback', 'transaction_id')->where('ftype', '=', 'auction');
    }

    public function winnerReview() {
        return $this->hasOne('App\Feedback', 'transaction_id')->where('ftype', '=', 'winner');
    }
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
}
