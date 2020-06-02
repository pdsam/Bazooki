<?php

namespace App\Http\Controllers;

use App\AuctionTransaction;
use App\Bazooker;
use App\Feedback;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function postAuctioneerReview(Request $request, AuctionTransaction $transaction) {
        try {
            $this->authorize('reviewAuctioneer', $transaction);
        } catch (AuthorizationException $e) {
            return redirect()->route('auctions')->withErrors([
                'auth' => 'You have no permission to post a review about this bazooker.'
            ]);
        }

        if ($transaction->auctioneerReview()->exists()) {
            return redirect('auctions')->withErrors([
                'transaction'=>'Auctioneer already reviewed in this transaction.'
            ]);
        }

        $validator = Validator::make($request->only('rating', 'opinion'), [
            'rating'=>'required|numeric|max:10|min:1',
            'opinion'=>'nullable|max:1000'
        ], [
            'rating'=>'The rating must be a number between 1 and 10.',
            'opinion'=>'The review must be no longer than 1000 characters.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('rating','opinion'));
        }

        Feedback::create([
            'ftype'=>'auction',
            'rating' => $request->input('rating'),
            'opinion' => $request->input('opinion'),
            'rater_id' => $transaction->senderBaz->id,
            'rated_id' => $transaction->receiverBaz->id,
            'transaction_id' => $transaction->id
        ]);

        return redirect()->route('auctions');
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

    public function postWinnerReview(Request $request, AuctionTransaction $transaction) {
        try {
            $this->authorize('reviewWinner', $transaction);
        } catch (AuthorizationException $e) {
            return redirect()->route('auctions')->withErrors([
                'auth' => 'You have no permission to post a review about this bazooker.'
            ]);
        }

        if ($transaction->winnerReview()->exists()) {
            return redirect('auctions')->withErrors([
                'transaction'=>'Winner already reviewed in this transaction.'
            ]);
        }

        $validator = Validator::make($request->only('rating', 'opinion'), [
            'rating'=>'required|numeric|max:10|min:1',
            'opinion'=>'nullable|max:1000'
        ], [
            'rating'=>'The rating must be a number between 1 and 10.',
            'opinion'=>'The review must be no longer than 1000 characters.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('rating','opinion'));
        }

        Feedback::create([
            'ftype'=>'winner',
            'rating' => $request->input('rating'),
            'opinion' => $request->input('opinion'),
            'rater_id' => $transaction->receiverBaz->id,
            'rated_id' => $transaction->senderBaz->id,
            'transaction_id' => $transaction->id
        ]);

        return redirect()->route('auctions');
    }
}
