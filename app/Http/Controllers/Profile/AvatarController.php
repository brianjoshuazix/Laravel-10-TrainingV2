<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;

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

    public function generate(Request $request) {

        $result = OpenAI::images()->create([
                'prompt' => "create avatar for user with cool style animated",
                'n' => 2,
                'size' => '512x512',
            ]);

        $contents = file_get_contents($result->data[0]->url);

        $filename = Str::random(25);

        if ($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        Storage::disk('public')->put("/avatars/$filename.jpg", $contents);

        auth()->user()->update(['avatar' => "/avatars/$filename.jpg"]);

        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');

    }
}
