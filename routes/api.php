<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('register',[RegisterController::class, 'register']);
Route::post('login',[LoginController::class, 'login']);
Route::post('forgot-password',[ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('reset-password',[ResetPasswordController::class, 'reset'])->name('password.reset');


Route::middleware('auth:api')->group(function () {

    Route::post('logout',[LoginController::class, 'logout']);
    Route::middleware('can:manage-users')->group(function() {

        Route::post('/users/{user}/block', [UserController::class, 'block']);
        Route::post('/users/{user}/unblock', [UserController::class, 'unblock']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::get('/users',[UserController::class, 'index']);

        Route::post('/formateurs',[FormateurController::class, 'storeFormateur']);
        Route::put('/formateurs/{formateur}',[FormateurController::class, 'updateFormateur']);
        Route::delete('/formateurs/{formateur}',[FormateurController::class, 'deleteFormateur']);
        Route::get('/formateurs',[FormateurController::class, 'indexFormateur']);
        Route::get('/formateurs/{formateur}',[FormateurController::class, 'showFormateur']);

    });

    Route::put('/profile/info',[ProfileController::class, 'updateInfo']);
    Route::put('/profile/password',[ProfileController::class, 'changePassword']);

});
