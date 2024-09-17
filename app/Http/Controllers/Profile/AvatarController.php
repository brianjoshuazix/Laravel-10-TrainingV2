<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        // store avatar field
        // return back()->with('message', 'Avatar is Changed');

        $path = Storage::disk('public')->put('avatars',$request->file('avatar'));

        // dd($path);


        // $path = $request->file('avatar')->store('avatars', 'public');


        if ($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        auth()->user()->update(['avatar' => $path]);

        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
