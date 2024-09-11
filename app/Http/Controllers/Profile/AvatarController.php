<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function update() {
        // store avatar field
        // return back()->with('message', 'Avatar is Changed');
        return redirect(route('profile.edit'));
    }
}
