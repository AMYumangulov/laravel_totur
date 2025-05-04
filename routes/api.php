<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\LogMiddleware;
use App\Http\Middleware\PermisionCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/login', [AuthController::class,'login']);
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'auth'],
    function () {
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::post('me', [AuthController::class,'me']);

    });
Route::group(['middleware' => ['jwt.auth',LogMiddleware::class, PermisionCheck::class]], function(){
Route::apiResource('posts', PostController::class);
});
//'middleware' => 'jwt.auth',
Route::group([ 'middleware' => PermisionCheck::class, 'prefix'=>'videos'], function(){
    Route::get('', [VideoController::class, 'index']);
    Route::get('{video}', [VideoController::class, 'show']);
    Route::post('', [VideoController::class, 'store']);
    Route::patch('{video}', [VideoController::class, 'update']);
    Route::delete('{video}', [VideoController::class, 'destroy']);
});

Route::group(['prefix'=>'categories'], function(){
    Route::get('', [CategoryController::class, 'index']);
    Route::get('{category}', [CategoryController::class, 'show']);
    Route::post('', [CategoryController::class, 'store']);
    Route::patch('{category}', [CategoryController::class, 'update']);
    Route::delete('{category}', [CategoryController::class, 'destroy']);
});

Route::group(['prefix'=>'comments'], function(){
    Route::get('', [CommentController::class, 'index']);
    Route::get('{comment}', [CommentController::class, 'show']);
    Route::post('', [CommentController::class, 'store']);
    Route::patch('{comment}', [CommentController::class, 'update']);
    Route::delete('{comment}', [CommentController::class, 'destroy']);
});

Route::group(['prefix'=>'likes'], function(){
    Route::get('', [LikeController::class, 'index']);
    Route::get('{like}', [LikeController::class, 'show']);
    Route::post('', [LikeController::class, 'store']);
    Route::patch('{like}', [LikeController::class, 'update']);
    Route::delete('{like}', [LikeController::class, 'destroy']);
});

Route::group(['prefix'=>'profiles'], function(){
    Route::get('', [ProfileController::class, 'index']);
    Route::get('{profile}', [ProfileController::class, 'show']);
    Route::post('', [ProfileController::class, 'store']);
    Route::patch('{profile}', [ProfileController::class, 'update']);
    Route::delete('{profile}', [ProfileController::class, 'destroy']);
});

Route::group(['prefix'=>'roles'], function(){
    Route::get('', [RoleController::class, 'index']);
    Route::get('{role}', [RoleController::class, 'show']);
    Route::post('', [RoleController::class, 'store']);
    Route::patch('{role}', [RoleController::class, 'update']);
    Route::delete('{role}', [RoleController::class, 'destroy']);
});

Route::group(['prefix'=>'tags'], function(){
    Route::get('', [TagController::class, 'index']);
    Route::get('{tag}', [TagController::class, 'show']);
    Route::post('', [TagController::class, 'store']);
    Route::patch('{tag}', [TagController::class, 'update']);
    Route::delete('{tag}', [TagController::class, 'destroy']);
});

Route::group(['prefix'=>'users'], function(){
    Route::get('', [UserController::class, 'index']);
    Route::get('{user}', [UserController::class, 'show']);
    Route::post('', [UserController::class, 'store']);
    Route::patch('{user}', [UserController::class, 'update']);
   Route::delete('{user}', [UserController::class, 'destroy']);
});
