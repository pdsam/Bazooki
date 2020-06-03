<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
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
            return redirect('auctions')->withErrors(['You must be authenticated to access that resource']);
        }

        $user = Bazooker::find($id);

        if ($user == null || $user->isBanned()) {
            return redirect('auctions')->withErrors(['User does not exist']);
        }

        return view('pages.profile', ['user' => $user]);
    }

    public function editProfile(Request $request, Bazooker $bazooker) {
        try {
            $this->authorize('editProfile', $bazooker);
        }
        catch (AuthorizationException $exception) {
            return redirect('profile/'.$bazooker->id)->withErrors(['You are not authorized to perform that operation']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:512',
            'profilePic' => 'image|max:2048'
        ], [
            'name.required' => 'Name must not be null',
            'name.max' => 'Name is too long',
            'description' => 'Description is too long.',
            'profilePic.image' => 'Profile picture must be of format jpeg, png, bmp, gif, svg, or webp',
            'profilePic.max' => 'Image must not exceed 2MB'
        ]);

        if ($validator->fails()) {
            return redirect('profile/'.$bazooker->id)->withErrors($validator);
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

        return redirect()->route('profile', ['id'=>$bazooker->id])->with('successMsg', 'Successfully edited profile');
    }

    public function settings() {
        $bazooker = Auth::guard('bazooker')->user();
        if (is_null($bazooker)) {
            return redirect('auctions')->withErrors(['You must be authenticated to access that resource']);
        }

        return view('pages.settings', ['payment_methods' => $bazooker->paymentMethods]);
    }

    public function deleteAccount(Request $request, Bazooker $bazooker){
        $this->authorize('editProfile', $bazooker);

        return redirect('auctions')->with('successMsg', 'Successfully deleted account');
    }
}
