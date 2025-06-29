<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    // return Inertia::render('Welcome');
    return redirect()->route('login');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::bind('user', function ($value) {
    return User::withTrashed()
        ->where('slug', $value)
        ->firstOrFail();
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get(
        '/users/archived',
        [UserController::class, 'archived']
    )->name('users.archived');
    Route::resource('users', UserController::class);
    Route::post(
        'users/{user}/restore',
        [UserController::class, 'restore']
    )->name('users.restore');
});