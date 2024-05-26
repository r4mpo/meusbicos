<?php

namespace App\Http\Controllers\VacanciesUsers;

use App\Http\Controllers\Controller;
use App\Models\Vacancies\Vacancy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacanciesApplications extends Controller
{
    public function myApplications(): JsonResponse
    {
        $user = Auth::user();
        $vacancies = $user->vacancy;

        return response()->json([
            'data' => $vacancies
        ]);
    }

    public function toApplyOrUnapply($vacancy_id, $action): JsonResponse
    {
        $user = Auth::user();
        $vacancy = Vacancy::findOrFail($vacancy_id);

        if (empty($user) || empty($vacancy)) {
            throw new \Exception('invalid data');
        }

        $action = strtolower($action);

        if ($action != 'attach' && $action != 'detach') {
            throw new \Exception('invalid action');
        }

        $user->vacancy()->$action($vacancy_id);

        return response()->json(['user ' . $user->name . ' ' . ($action == 'attach' ? 'applied' : 'disappointed') . ' to ' . $vacancy->short_description]);
    }
}
