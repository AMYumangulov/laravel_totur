<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::post('posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::patch('posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');

    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');

    Route::get('comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::get('comments/create', [CommentController::class, 'create'])->name('admin.comments.create');
    Route::get('comments/{comment}', [CommentController::class, 'show'])->name('admin.comments.show');
    Route::post('comments', [CommentController::class, 'store'])->name('admin.comments.store');

    Route::get('profiles', [ProfileController::class, 'index'])->name('admin.profiles.index');
    Route::get('profiles/create', [ProfileController::class, 'create'])->name('admin.profiles.create');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('admin.profiles.show');
    Route::post('profiles', [ProfileController::class, 'store'])->name('admin.profiles.store');

    Route::get('tags', [TagController::class, 'index'])->name('admin.tags.index');
    Route::get('tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    //Route::get('tags/{tag}', [TagController::class, 'show'])->name('admin.tags.show');
    Route::get('tags/{id}', [TagController::class, 'show'])->name('admin.tags.show');
    Route::delete('tags/{tag}', [TagController::class, 'destroy'])->name('admin.tags.destroy');
    Route::post('tags', [TagController::class, 'store'])->name('admin.tags.store');

    Route::get('statistics', [StatisticController::class, 'index'])->name('admin.statistics.index');
});
