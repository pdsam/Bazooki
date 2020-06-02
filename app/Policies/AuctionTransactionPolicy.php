<?php

namespace App\Policies;

use App\Auction;
use App\AuctionTransaction;
use App\Bazooker;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuctionTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function reviewAuctioneer(Bazooker $baz, AuctionTransaction $transaction) {
        return $baz->id == $transaction->senderBaz->id;
    }

    public function reviewWinner(Bazooker $baz, AuctionTransaction $transaction) {
        return $baz->id == $transaction->receiverBaz->id;
    }
}
