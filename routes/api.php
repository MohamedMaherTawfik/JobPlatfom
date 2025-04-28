<?php

use App\Http\Controllers\api\user\commentController;
use App\Http\Controllers\api\user\postController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\api\user\followController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('jwt.auth');
    Route::post('refresh', [AuthController::class, 'refresh'])->middleware('jwt.auth');
    Route::post('profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/follow/{user}', [followController::class, 'follow']);
    Route::delete('/unfollow/{user}', [FollowController::class, 'unfollow']);
    Route::get('/followers/{user}', [FollowController::class, 'followers']);
    Route::get('/following/{user}', [FollowController::class, 'following']);
});


Route::group([
    'prefix' => 'post'
],function (){
    Route::get('/',[postController::class,'index']);
    Route::get('/{id}',[postController::class,'show']);
    Route::post('/',[postController::class,'store'])->middleware('jwt.auth');
    Route::post('/{id}',[postController::class,'update'])->middleware('jwt.auth');
    Route::delete('/',[postController::class,'destroy'])->middleware('jwt.auth');
});

Route::group([
],function (){
    Route::get('/comments',[commentController::class,'index']);
    Route::get('/comment/{id}',[commentController::class,'show']);
    Route::post('/comments/{post_id}',[commentController::class,'store'])->middleware('jwt.auth');
    Route::post('/comment/{id}',[commentController::class,'update'])->middleware('jwt.auth');
    Route::delete('/comments/{id}',[commentController::class,'destroy'])->middleware('jwt.auth');
});

