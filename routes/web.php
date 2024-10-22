<?php

use App\Http\Controllers\ProfileController;
use App\Events\MessagingEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gamba', function () {
    return view('gamba');
})->middleware(['auth', 'verified'])->name('gamba');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.route')->middleware(['web', 'auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/broadcast', function () {
    broadcast(new MessagingEvent());
});

require __DIR__.'/auth.php';
