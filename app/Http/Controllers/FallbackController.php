<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FallbackController extends Controller
{

    public function notfound() {
        return view('pages.404');
    }
}
