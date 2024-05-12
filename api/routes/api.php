<?php

use App\Http\Controllers\Users\AuthController as Auth;
use App\Http\Controllers\Vagas\VagasController as Vagas;
use App\SwaggerComments as Swagger;
use Illuminate\Support\Facades\Route;

Route::post('documentation', [Swagger::class, 'documentation'])->name('api.documentation.swagger');

Route::group(['middleware' => 'api'], function ($router) {

    Route::resource('vagas', Vagas::class);

    Route::group(['prefix' => 'auth'], function ($routerAuth) {
        Route::post('login', [Auth::class, 'login'])->name('api.auth.login');
        Route::post('register', [Auth::class, 'create'])->name('api.auth.create');
        Route::post('logout', [Auth::class, 'logout'])->name('api.auth.logout');
        Route::post('refresh', [Auth::class, 'refresh'])->name('api.auth.refresh');
        Route::post('me', [Auth::class, 'me'])->name('api.auth.me');
    });

});