<?php

use App\Http\Controllers\Users\AuthController as Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [Auth::class, 'login']);
    Route::post('logout', [Auth::class, 'logout']);
    Route::post('refresh', [Auth::class, 'refresh']);
    Route::post('me', [Auth::class, 'me']);
});