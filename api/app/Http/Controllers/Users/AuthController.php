<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Auth;
use  App\Http\Requests\Users\Create as Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'create']]);
    }


    /**
     * Realiza o login e retorna um token JWT.
     *
     * @OA\Post(
     *      path="/api/auth/login",
     *      operationId="login",
     *      tags={"Autenticação"},
     *      summary="Realiza o login e retorna um token JWT.",
     *      description="Realiza o login e retorna um token JWT.",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Credenciais de login",
     *          @OA\JsonContent(
     *              required={"email", "password"},
     *              @OA\Property(property="email", type="string", example="giovana@email.com"),
     *              @OA\Property(property="password", type="string", example="giovana3#_!.G"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Token JWT gerado com sucesso.",
     *          @OA\JsonContent(
     *              @OA\Property(property="access_token", type="string", example="token"),
     *              @OA\Property(property="token_type", type="string", example="bearer"),
     *              @OA\Property(property="expires_in", type="integer", example=3600)
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciais inválidas.",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Não autorizado")
     *          )
     *      )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Não autorizado.'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="createUser",
     *      tags={"Usuários"},
     *      summary="Cria um novo usuário.",
     *      description="Cria um novo usuário.",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Informações do usuário",
     *          @OA\JsonContent(
     *              required={"name", "email", "password"},
     *              @OA\Property(property="name", type="string", example="Giovana"),
     *              @OA\Property(property="email", type="string", example="giovana@email.com"),
     *              @OA\Property(property="password", type="string", example="giovana3#_!.G"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Usuário cadastrado com sucesso!",
     *          @OA\JsonContent(
     *              @OA\Property(property="user", type="object", example={}),
     *              @OA\Property(property="data", type="object", example={}),
     *              @OA\Property(property="message", type="string", example="Usuário cadastrado com sucesso!"),
     *              @OA\Property(property="success", type="boolean", example=true)
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Houve um problema ao cadastrar o usuário :(",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Houve um problema ao cadastrar o usuário :("),
     *              @OA\Property(property="success", type="boolean", example=false),
     *              @OA\Property(property="error", type="string", example="Detalhes do erro"),
     *              @OA\Property(property="code", type="integer", example=500)
     *          )
     *      )
     * )
     */
    public function create(Request $request)
    {
        try {
            $data = $request->only(['name', 'email', 'password']);
            $user = User::create($data);

            return response()->json([
                'user' => $user,
                'data' => $data,
                'message' => 'Usuário cadastrado com sucesso.',
                'success' => true
            ], http_response_code(200));
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Houve um problema ao cadastrar o usuário.',
                'success' => false,
                'error' => $th->getMessage(),
                'code' => $th->getCode()
            ], http_response_code(500));
        }
    }

    /**
     * Informações sobre o usuário autenticado.
     *
     * @OA\Post(
     *      path="/api/auth/me",
     *      operationId="me",
     *      tags={"Autenticação"},
     *      summary="Informações sobre o usuário autenticado.",
     *      description="Informações sobre o usuário autenticado.",
     *      @OA\Response(
     *          response=200,
     *          description="Informações do usuário recuperadas com sucesso.",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example="444"),
     *              @OA\Property(property="name", type="string", example="Giovana"),
     *              @OA\Property(property="email", type="string", example="giovana@gmail.com"),
     *              @OA\Property(property="email_verified_at", type="string", example="null"),
     *              @OA\Property(property="created_at", type="string", example="2024-05-01T18:31:41.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2024-05-01T18:31:41.000000Z")
     *          )
     *      )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Desconecta o usuário e invalida o token JWT.
     *
     * @OA\Post(
     *      path="/api/auth/logout",
     *      operationId="logout",
     *      tags={"Autenticação"},
     *      summary="Desconecta o usuário e invalida o token JWT.",
     *      description="Desconecta o usuário e invalida o token JWT.",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(
     *          response=200,
     *          description="Usuário desconectado com sucesso.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Usuário desconectado com sucesso!")
     *          )
     *      )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout efetuado com sucesso.']);
    }

    /**
     * Restaurar token do usuário.
     *
     * @OA\Post(
     *      path="/api/auth/refresh",
     *      operationId="refresh",
     *      tags={"Autenticação"},
     *      summary="Restaurar token do usuário.",
     *      description="Restaurar token do usuário.",
     *      @OA\Response(
     *          response=200,
     *          description="Informações do usuário recuperadas com sucesso.",
     *          @OA\JsonContent(
     *              @OA\Property(property="access_token", type="string", example="token"),
     *              @OA\Property(property="token_type", type="string", example="bearer"),
     *              @OA\Property(property="expires_in", type="integer", example=3600)
     *          )
     *      )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Retorna a resposta com o token JWT.
     *
     * @param $token
     * @return \Illuminate\Http\JsonResponse
    */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
