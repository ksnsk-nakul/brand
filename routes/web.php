<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

//  Github Auth
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    
    $user = User::firstOrCreate([
        'email' => $githubUser->getEmail(),
    ], [
        'name' => $githubUser->getName() ?? $githubUser->getNickname(),
        'provider_id' => $githubUser->getId(),
        'provider_name' => 'github',
        'provider_token' => $githubUser->token,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});