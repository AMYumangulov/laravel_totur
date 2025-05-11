<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('test', [DashboardController::class, 'test'])->name('test');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.likes.toggle');
    Route::post('posts/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comments.store');
    Route::get('posts/{post}/comment', [PostController::class, 'indexComment'])->name('posts.comments.index');
    Route::get('posts/{comment}/childComment', [PostController::class, 'childComment'])->name('posts.comments.child');
    Route::get('posts/{post}/countComment', [PostController::class, 'countComment'])->name('posts.comments.count');
    Route::post('posts/{post}/repost', [PostController::class, 'repost'])->name('post.repost');

    Route::post('comments/{comment}/toggle-like', [PostController::class, 'toggleLikeComment'])->name('comments.likes.toggle');
    Route::get('comments/{comment}', [PostController::class, 'showComment'])->name('comments.show');

});
