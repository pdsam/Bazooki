<?php

namespace App\Http\Controllers;

use App\AuctionTransaction;
use App\Bazooker;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:bazooker');
    }

    public function reviewAuctioneer(Request $request, AuctionTransaction $transaction) {
        try {
            $this->authorize('reviewAuctioneer', $transaction);
        } catch (AuthorizationException $e) {
            return redirect()->route('auctions')->withErrors([
                'auth' => 'You have no permission to post a review about this bazooker.'
            ]);
        }

        $auctioneer = Bazooker::find($transaction->receiverBaz->id);

        return view('pages.reviewauctioneer', [
            'transaction_id' => $transaction->id,
            'auctioneer' => $auctioneer
        ]);
    }

    public function reviewWinner(Request $request, AuctionTransaction $transaction) {
        try {
            $this->authorize('reviewWinner', $transaction);
        } catch (AuthorizationException $e) {
            return redirect()->route('auctions')->withErrors([
                'auth' => 'You have no permission to post a review about this bazooker.'
            ]);
        }

        $winner = Bazooker::find($transaction->senderBaz->id);

        return view('pages.reviewwinner', [
            'transaction_id' => $transaction->id,
            'winner' => $winner
        ]);
    }
}
