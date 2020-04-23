<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Bazooker;

class BazookerController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id = null)
    {
        if ($id == null) {
            if (Auth::check()) {
                $id = Auth::user()->id;
                return redirect()->route('profile', ['id'=>$id]);
            }
            return redirect('auctions');
        }

        $user = Bazooker::find($id);

        if ($user == null) {
            return redirect('auctions');
        }

        return view('pages.profile', ['user' => $user]);
    }

    public function editProfile(Request $request, Bazooker $bazooker) {
        $this->authorize('editProfile', $bazooker);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'string|max:200'
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')
                ->withErrors($validator);
        }

        $bazooker->update($request->only('name','description'));

        return redirect()->route('profile', ['id'=>$bazooker->id]);
    }

    public function settings() {
        if (!Auth::check()) {
            return redirect('auctions');
        }

        return view('pages.settings');
    }
}
?>
