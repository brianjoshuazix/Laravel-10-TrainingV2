<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
    // fetch all users
    // $users = DB::select("select * from users");
    $users = DB::table('users')->find(1);

    // create new users
    // $user = DB::insert('insert into users (name, email, password) values (?, ?, ?)', [
    //     'Azzahra',
    //     'az@gmail.com',
    //     '12345']);
    // $user = DB::table('users')->insert([
    //     'name' => 'Zahra',
    //     'email' => 'zahra@gmail.com',
    //     'password' => 'zahra'
    // ]);

    // update users
    // $user = DB::update("update users set email=? where id=?", [
    //     'az123@gmail.com',
    //     2,
    // ]);
    // $user = DB::table('users')->where('id', 3)->update(['email' => 'zahra145@gmail.com']);

    // delete a user
    // $user = DB::delete("delete from users where id=2");
    // $user = DB::table('users')->where('id', 3)->delete();

    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
