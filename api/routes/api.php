<?php

use App\Http\Controllers\Users\AuthController as Auth;
use App\SwaggerComments as Swagger;
use Illuminate\Support\Facades\Route;

Route::post('documentation', [Swagger::class,'documentation'])->name('api.documentation.swagger');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [Auth::class, 'login'])->name('api.auth.login');
    Route::post('register', [Auth::class, 'create'])->name('api.auth.create');
    Route::post('logout', [Auth::class, 'logout'])->name('api.auth.logout');
    Route::post('refresh', [Auth::class, 'refresh'])->name('api.auth.refresh');
    Route::post('me', [Auth::class, 'me'])->name('api.auth.me');
});