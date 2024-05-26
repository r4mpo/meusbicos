<?php

use App\Http\Controllers\Users\AuthController as Auth;
use App\Http\Controllers\Vacancies\VacanciesController as Vacancy;
use App\SwaggerComments as Swagger;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacanciesUsers\MyPublishedVacanciesController as MyPublishedVacancies;
use App\Http\Controllers\VacanciesUsers\VacanciesApplications as Applications;

Route::post('documentation', [Swagger::class, 'documentation'])->name('api.documentation.swagger');

Route::group(['middleware' => 'api'], function () {

    Route::resource('vacancies', Vacancy::class);

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [Auth::class, 'login'])->name('api.auth.login');
        Route::post('register', [Auth::class, 'create'])->name('api.auth.create');
        Route::post('logout', [Auth::class, 'logout'])->name('api.auth.logout');
        Route::post('refresh', [Auth::class, 'refresh'])->name('api.auth.refresh');
        Route::post('me', [Auth::class, 'me'])->name('api.auth.me');
    });

    Route::group(['prefix' => 'vacancies_user'], function () {
        Route::get('my_published_vacancies', [MyPublishedVacancies::class, 'myPublishedVacancies'])->name('api.vacancies_user.my_published_vacancies');
        Route::get('my_applications_vacancies', [Applications::class, 'myApplications'])->name('api.vacancies_user.my_applications_vacancies');
        Route::get('to_apply_or_unapply/{vacancy_id}/{action}', [Applications::class, 'toApplyOrUnapply'])->name('api.vacancies_user.to_apply_or_unapply');
    });
});