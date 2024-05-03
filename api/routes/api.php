<?php

use App\Http\Controllers\Users\AuthController as Auth;
use App\SwaggerComments;
use Illuminate\Support\Facades\Route;

Route::post('documentation', [SwaggerComments::class,'documentation'])->name('api.documentation.swagger');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [Auth::class, 'login']);
    Route::post('register', [Auth::class, 'create']);
    Route::post('logout', [Auth::class, 'logout']);
    Route::post('refresh', [Auth::class, 'refresh']);
    Route::post('me', [Auth::class, 'me']);
});