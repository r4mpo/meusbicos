<?php

namespace App\Http\Controllers\Vacancies;

use App\Http\Controllers\Controller;
use App\Models\Vacancies\Vacancy;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Vacancies\Create as CreateRequest;
use App\Http\Requests\Vacancies\Update as UpdateRequest;
use Illuminate\Http\JsonResponse;

class VacanciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index() // query param optional: ?page=X (x = number page)
    {
        try {
            $params = request();

            $zip_code = $params['zip_code'] ? preg_replace('/\D/', '', $params['zip_code']) : '';
            $wage = $params['wage'] ? preg_replace('/\D/', '', $params['wage']) : '';

            $short_description = $params['short_description'] ?? '';
            $long_description = $params['long_description'] ?? '';

            $qtd_page = $params['qtd_page'] ?? 10;

            $Vacancies = DB::table('Vacancies')
                ->join('users', 'Vacancies.user_id', '=', 'users.id')
                ->select('Vacancies.*', 'users.name as user')
                ->whereNull('deleted_at');

            if (!empty($zip_code)) {
                $Vacancies = $Vacancies->where('zip_code', '=', $zip_code);
            }

            if (!empty($wage)) {
                $Vacancies = $Vacancies->where('wage', '=', $wage);
            }

            if (!empty($short_description)) {
                $Vacancies = $Vacancies->where('short_description', 'like', $short_description);
            }

            if (!empty($long_description)) {
                $Vacancies = $Vacancies->where('long_description', 'like', $long_description);
            }

            $Vacancies = $Vacancies->orderBy('created_at', 'desc')->paginate($qtd_page);

            $params_url = [
                'previous' => $Vacancies->previousPageUrl(),
                'next' => $Vacancies->nextPageUrl(),
            ];

            $Vacancies = $Vacancies->map(function ($vacancy) {
                return [
                    'id' => $vacancy->id,
                    'short_description' => $vacancy->short_description,
                    'long_description' => $vacancy->long_description,
                    'wage' => $this->format("money", $vacancy->wage),
                    'zip_code' => $vacancy->zip_code,
                    'user' => $vacancy->user,
                ];
            });

            return response()->json([
                'data' => $Vacancies,
                'pages' => $params_url,
            ]);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

    public function store(CreateRequest $request): JsonResponse
    {
        $dados = $request->only('short_description', 'long_description', 'wage', 'zip_code', 'user_id');

        try {
            $vacancy = Vacancy::create($dados);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        return response()->json(['data' => $vacancy]);
    }

    public function show(string $id): JsonResponse
    {
        try {
            $vacancy = Vacancy::findOrFail($id);

            return response()->json(['data' => [
                'id' => $vacancy->id,
                'short_description' => $vacancy->short_description,
                'long_description' => $vacancy->long_description,
                'wage' => $this->format("money", $vacancy->wage),
                'zip_code' => $this->format("zip_code", $vacancy->zip_code),
                'user' => $vacancy->user
            ]]);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $dados = $request->only('short_description', 'long_description', 'wage', 'zip_code', 'user_id');

        try {
            $vacancy = Vacancy::findOrFail($id);

            $userId = auth()->user()->id;

            if ($vacancy->user_id != $userId) {
                throw new \Exception('not authorized.');
            }

            $vacancy->update($dados);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        return response()->json(['data' => $vacancy]);
    }

    public function destroy(string $id): JsonResponse
    {
        try {

            $vacancy = Vacancy::findOrFail($id);

            $userId = auth()->user()->id;

            if ($vacancy->user_id != $userId) {
                throw new \Exception('not authorized.');
            }

            $vacancy->delete();

            return response()->json(['vacancy successfully deleted']);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }
}
