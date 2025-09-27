<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->as('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('blog', BlogController::class);
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('comments', CommentController::class);
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');

});

require __DIR__.'/auth.php';
