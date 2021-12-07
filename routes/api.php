<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotivasiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::prefix('v1')->group(function () {

    // Public Route
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');


    // Private Route
    Route::group(['middleware' => ['auth:sanctum']], function () {

        // Partial Route
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

        // Resource Route
        Route::resource('user', UserController::class)->except(['update', 'create','delete','edit','destroy']);
        Route::resource('motivasi', MotivasiController::class)->except(['create','edit',]);
    });
});
