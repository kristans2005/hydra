<?php

use App\Http\Controllers\ProfileController;
use App\Events\MessagingEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GambaController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gamba', function () {
    return view('gamba');
})->middleware(['middleware' => AdminMiddleware::class])->name('gamba');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::group(['middleware' => AdminMiddleware::class], function () {
   
// });
 //Route::get('/gamba', [GambaController::class, 'index'])->name('gamba.index');

    // Route::group(['middleware' => AdminMiddleware::class], function () {

    //     Route::get('/gamba', [GambaController::class, 'index'])->name('gamba.index');

    // });

Route::get('/broadcast', function () {
    broadcast(new MessagingEvent());
});

require __DIR__.'/auth.php';
