<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Auth;
use  App\Http\Requests\Users\Create as Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'create']]);
    }

    /**
     * Get a JWT via given credentials.
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
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Logout efetuado com sucesso.']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
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
