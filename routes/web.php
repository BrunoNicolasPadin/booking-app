<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'gauth_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
    ]);

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
})->name('google.callback');

Route::resource('bookings', BookingController::class);
Route::post('bookings/clone', [BookingController::class, 'clone'])->name('bookings.clone');
