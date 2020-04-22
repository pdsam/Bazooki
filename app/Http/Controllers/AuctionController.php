<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Bazooker;

class AuctionController extends Controller
{
    /**
     * Show the form to create a new auction
     *
     * @return View
     */
    public function createForm()
    {
        if(!Auth::check()) {
            return redirect('auctions');
        }

        return view('pages.create_auction');
    }
}
?>
