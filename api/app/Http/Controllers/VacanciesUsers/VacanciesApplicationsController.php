<?php

namespace App\Http\Controllers\VacanciesUsers;

use App\Http\Controllers\Controller;
use App\Models\Vacancies\Vacancy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacanciesApplicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @OA\Get(
     *      path="/api/vacancies_user/my_applications_vacancies",
     *      operationId="myApplications",
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
    public function myApplications(): JsonResponse
    {
        $user = Auth::user();
        $vacancies = $user->vacancy;

        return response()->json([
            'data' => $vacancies
        ]);
    }

    /**
     * @OA\Get(
     *      path="/api/vacancies_user/to_apply_or_unapply/{vacancy_id}/{action}",
     *      operationId="toApplyOrUnapply",
     *      tags={"VacanciesUsers"},
     *      summary="Apply or unapply to a vacancy",
     *      description="Apply or unapply to a specific vacancy.",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="vacancy_id",
     *          in="path",
     *          description="ID of the vacancy.",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="action",
     *          in="path",
     *          description="Action to perform (attach or detach).",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              enum={"attach", "detach"}
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success message confirming the action.",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User John applied to Vacancy XYZ"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Invalid data or action provided.",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="error",
     *                  type="string",
     *                  example="Invalid data or action provided."
     *              )
     *          )
     *      )
     * )
     */
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
