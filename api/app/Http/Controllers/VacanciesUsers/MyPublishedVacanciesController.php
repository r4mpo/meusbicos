<?php

namespace App\Http\Controllers\VacanciesUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPublishedVacanciesController extends Controller
{
    public function myPublishedVacancies(): JsonResponse
    {
        $user = Auth::user();
        $vacancies = $user->getVacanciesWithMyUserId;

        return response()->json([
            'data' => $vacancies
        ]);
    }
}
