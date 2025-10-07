<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

// Sitemap

route::get('sitemap.xml', [SitemapController::class, 'show'])->name('sitemap')->middleware('cache.headers:public;max_age=3600;etag');

Route::middleware('language_guard')->as('tr.')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('hakkimda', [FrontendController::class, 'about'])->name('about');
    Route::get('iletisim', [FrontendController::class, 'contact'])->name('contact');
    Route::get('blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('blog/{slug}', [FrontendController::class, 'viewpost'])->name('blog.view');
    Route::get('portfolyo', [FrontendController::class, 'portfolio'])->name('portfolio');
    Route::get('portfolyo/{slug}', [FrontendController::class, 'viewportfolio'])->name('portfolio.view');
});

Route::middleware('language_guard')->prefix('en')->as('en.')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('about-me', [FrontendController::class, 'about'])->name('about');
    Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('blog/{slug}', [FrontendController::class, 'viewpost'])->name('blog.view');
    Route::get('portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
    Route::get('portfolio/{slug}', [FrontendController::class, 'viewportfolio'])->name('portfolio.view');
});

Route::middleware('language_guard')->prefix('de')->as('de.')->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::get('uber-mich', [FrontendController::class, 'about'])->name('about');
    Route::get('kontakt', [FrontendController::class, 'contact'])->name('contact');
    Route::get('blog', [FrontendController::class, 'blog'])->name('blog');
    Route::get('blog/{slug}', [FrontendController::class, 'viewpost'])->name('blog.view');
    Route::get('portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
    Route::get('portfolio/{slug}', [FrontendController::class, 'viewportfolio'])->name('portfolio.view');
});

RateLimiter::for('send-message', fn($request) =>
    [Limit::perMinute(2)->by($request->ip()),
     Limit::perHour(5)->by($request->ip())]
);

Route::post('send-message', [ContactController::class, 'sendMessage'])->name('contact.message.send')
->middleware('throttle:send-message');

Route::middleware(['auth', 'role:admin', 'admin.language'])->as('admin.')->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
    Route::resource('blog', BlogController::class);
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('comments', CommentController::class);
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/view/{message}', [MessageController::class, 'viewMessage'])->name('message.view');
    Route::delete('messages/destroy/{message}', [MessageController::class, 'destroyMessage'])->name('message.destroy');

    Route::put('settings/avatar-upload', [DashboardController::class, 'avatarChange'])->name('settings.avatar.upload');
    Route::put('settings/avatar-delete', [DashboardController::class, 'avatarDestroy'])->name('settings.avatar.destroy');
    Route::put('settings/name-change', [DashboardController::class, 'nameChange'])->name('settings.name.change');
    Route::put('settings/password-update', [DashboardController::class, 'updatePassword'])->name('settings.password.update');
    Route::put('settings/language-update', [DashboardController::class, 'updateLanguage'])->name('settings.language.update');

});

require __DIR__.'/auth.php';
