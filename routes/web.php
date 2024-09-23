<?php

use OpenAI\Laravel\Facades\OpenAI;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

use function Laravel\Prompts\select;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
    // fetch all users
    // $users = DB::select("select * from users");
    // $users = DB::table('users')->find(1);
    // $user = User::find(14);

    // create new users
    // $user = DB::insert('insert into users (name, email, password) values (?, ?, ?)', [
    //     'Azzahra',
    //     'az@gmail.com',
    //     '12345'
    // ]);
    // $user = DB::table('users')->insert([
    //     'name' => 'Zahra',
    //     'email' => 'zahra@gmail.com',
    //     'password' => 'zahra'
    // ]);
    // $user = User::create([
    //     'name' => 'Zahra',
    //     'email' => 'zahra8@gmail.com',
    //     'password' => 'zahra'
    // ]);

    // update users
    // $user = DB::update("update users set email=? where id=?", [
    //     'az123@gmail.com',
    //     2,
    // ]);
    // $user = DB::table('users')->where('id', 3)->update(['email' => 'zahra145@gmail.com']);
//     $user = User::find(5);
//     $user->update([
//         'email' => 'az@gmail.com'
//    ]);


    // delete a user
    // $user = DB::delete("delete from users where id=2");
    // $user = DB::table('users')->where('id', 3)->delete();
    // $user = User::find(5);
    // $user->delete();

    // dd($user->name);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar/ai', [AvatarController::class, 'generate'])->name('profile.avatar.ai');
});

require __DIR__ . '/auth.php';



// Route::get('/openai', function() {
//     $result = OpenAI::images()->create([
//         'prompt' => "create avatar for user with cool style animated",
//         'n' => 2,
//         'size' => '512x512',
//     ]);
//     // echo $result['choices'][0]['text'];
//     return response(['url' => $result->data[0]->url]);
// });

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();

    DD($user);

    // $user->token
});
