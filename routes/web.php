<?php

use App\Http\Controllers\ChattingController;
use App\Http\Controllers\ProfileController;
use App\Events\MessagingEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gamba', function () {
    return view('gamba');
})->middleware(['auth', 'verified'])->name('gamba');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/admin', function () {
    return view('admin');
})->middleware(['middleware' => AdminMiddleware::class])->name('admin');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat', [ChattingController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChattingController::class, 'send'])->name('chat.send');
});
// Route::group(['middleware' => AdminMiddleware::class], function () {

// });
//Route::get('/gamba', [GambaController::class, 'index'])->name('gamba.index');


require __DIR__ . '/auth.php';
