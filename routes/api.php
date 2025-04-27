<?php

use App\Http\Controllers\api\user\postController;
use App\Http\Controllers\auth\AuthController;
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


Route::group([
    'prefix' => 'post'
],function (){
    Route::get('/',[postController::class,'index']);
    Route::get('/{id}',[postController::class,'show']);
    Route::post('/',[postController::class,'store'])->middleware('jwt.auth');
    Route::put('/{id}',[postController::class,'update'])->middleware('jwt.auth');
    Route::delete('/',[postController::class,'destroy'])->middleware('jwt.auth');
});
