<?php
namespace App\Models;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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

    // Fetch all users
    //$users = DB::select("select * from users");
    //$users = DB::select("select * from users where email=?", ['sayantan12.dutta@gmail.com']);

    // Create new user
    // $user = DB::insert("insert into users (name, email, password) values (?,?,?)", [
    //     'Pritam Dutta',
    //     'pritam@gmail.com',
    //     'password'
    // ]);

    // update a user
    // $user = DB::update("update users set email=? where id=?", [
    //     'pritam12@gmail.com',
    //     3
    // ]);

    //delete a user
    // $user = DB::delete("delete from users where id=?", [3]);

    // Fetch all users by using query builder
    //$users = DB::table('users')->get();
    //$users = DB::table('users')->where('id', 2)->get();
    //$users = DB::table('users')->find(2);

    // Create new user by using query builder
    // $user = DB::table('users')->insert([
    //     "name" => "Pritam Manna",
    //     "email" => "pritam15@gmail.com",
    //     "password" => "password"
    // ]);

    // update a user by using query builder
    //$user = DB::table('users')->where('id', 5)->update(['email' => 'pritam33@gmail.com']);

    //delete a user by using query builder
    //$user = DB::table('users')->where('id', 5)->delete();

    // Fetch all users by using Eloquent Model
    //$users = User::get();
    //$users = User::all();
    //$user = User::find(8);
    //$users = DB::table('users')->where('id', 2)->get();
    //$users = DB::table('users')->find(2);

    // Create new user by using Eloquent Model
    // $user = User::create([
    //     "name" => "Ajoy Dutta",
    //     "email" => "ajoy12@gmail.com",
    //     "password" => "password"
    // ]);

    // update a user by using Eloquent Model
    //$user = User::where('id', 6)->update(['email' => 'pritam33@gmail.com']);

    //delete a user by using Eloquent Model
    //$user = User::where('id', 6)->delete();

    //dd($user);
    //dd($user->name);
    //dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
