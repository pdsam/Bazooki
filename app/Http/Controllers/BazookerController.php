<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Bazooker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BazookerController extends Controller
{
    public function show($id = null)
    {
        if ($id == null) {
            if (Auth::guard('bazooker')->check()) {
                $id = Auth::guard('bazooker')->user();
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
            'description' => 'nullable|string|max:200',
            'profilePic' => 'image|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')
                ->withErrors($validator);
        }

        $updateContent = $request->only('name','description');

        if (isset($request->profilePic)) {
            $profilePic = Image::make($request->file('profilePic'))->resize(null, 400, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg');
            $profilePicPath = "public/avatars/$bazooker->id";
            if (Storage::put($profilePicPath, $profilePic)) {
                $updateContent = Arr::add($updateContent, 'profile_pic', $profilePicPath);
            }
        }

        $bazooker->update($updateContent);

        return redirect()->route('profile', ['id'=>$bazooker->id]);
    }

    public function settings() {
        $bazooker = Auth::guard('bazooker')->user();
        if (is_null($bazooker)) {
            return redirect('auctions');
        }

        return view('pages.settings', ['payment_methods' => $bazooker->paymentMethods]);
    }

    public function activityPage() {
       if (!Auth::guard('bazooker')->check()) {
           return redirect()->route('auctions');
       }

       return view('pages.activity.main');
    }
}
