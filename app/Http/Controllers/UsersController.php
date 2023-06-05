<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->only([
            "updateProfile",
            "deleteAvatar"
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find($request->id);

        if(!$user)
        {
            return abort(404);
        }

        if($user->id !== Auth::user()->id)
        {
            return redirect()->route("profile-settings", Auth::user()->id);
        }

        $request->validate([
            "description" => ['max:1000'],
            "avatar" => ['mimes:png,jpg,jpeg', 'max:5000']
        ]);

        if(is_null($request->description))
        {
            $user->description = null;

        } else {
            $user->description = $request->description;
        }

        if($request->hasFile('avatar'))
        {
            if(!is_null($user->avatar))
            {
                $avatar = public_path() . $user->avatar;
                unlink($avatar);
            }

            $path = "/storage/" . $request->avatar->store("avatars", "public");
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route("profile", Auth::user()->id);
    }

    public function deleteAvatar(Request $request)
    {
        $user = User::find($request->id);

        if(!$user)
        {
            return abort(404);
        }

        if($user->id !== Auth::user()->id)
        {
            return redirect()->route("profile-settings", Auth::user()->id);
        }

        $avatar = public_path() . $user->avatar;
        unlink($avatar);

        $user->avatar = null;
        $user->save();

        return redirect()->route("profile", Auth::user()->id);
    }
}
