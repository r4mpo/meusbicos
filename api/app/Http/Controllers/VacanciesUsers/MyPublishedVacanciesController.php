<?php

namespace App\Http\Controllers\VacanciesUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPublishedVacanciesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *      path="/api/vacancies_user/my_published_vacancies",
     *      operationId="myPublishedVacancies",
     *      tags={"VacanciesUsers"},
     *      summary="Retrieve a list of vacancies published by the authenticated user",
     *      description="Returns a list of vacancies published by the authenticated user.",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="A list of vacancies published by the authenticated user.",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          example="2",
     *                          description="ID Vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="created_at",
     *                          type="string",
     *                          example="2024-05-26T22:40:21.000000Z",
     *                          description="Creation timestamp of vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="updated_at",
     *                          type="string",
     *                          example="2024-05-26T22:40:21.000000Z",
     *                          description="Update timestamp of vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="short_description",
     *                          type="string",
     *                          example="test update",
     *                          description="Short description of vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="long_description",
     *                          type="string",
     *                          example="Fazendo teste de tal tal tal.",
     *                          description="Long description of vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="wage",
     *                          type="integer",
     *                          example=777,
     *                          description="Wage of vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="zip_code",
     *                          type="string",
     *                          example="12345678",
     *                          description="Zip code (CEP) of vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="user_id",
     *                          type="integer",
     *                          example=2,
     *                          description="User ID who published the vacancy."
     *                      ),
     *                      @OA\Property(
     *                          property="deleted_at",
     *                          type="string",
     *                          example=null,
     *                          description="Deletion timestamp of vacancy."
     *                      )
     *                  )
     *              )
     *          )
     *      )
     * )
     */
    public function myPublishedVacancies(): JsonResponse
    {
        $user = Auth::user();
        $vacancies = $user->getVacanciesWithMyUserId;

        return response()->json([
            'data' => $vacancies
        ]);
    }
}
