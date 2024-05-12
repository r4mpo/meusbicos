<?php

namespace App\Http\Controllers\Vagas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vagas\Create as CreateRequest;
use App\Models\Vagas\Vaga;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Vagas\Update as UpdateRequest;
use Illuminate\Http\JsonResponse;

class VagasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index() // query param optional: ?page=X (x = number page)
    {
        try {
            $parametros = request();

            $cep = $parametros['cep'] ? preg_replace('/\D/', '', $parametros['cep']) : '';
            $remuneracao = $parametros['remuneracao'] ? preg_replace('/\D/', '', $parametros['remuneracao']) : '';

            $descricao_curta = $parametros['descricao_curta'] ?? '';
            $descricao_longa = $parametros['descricao_longa'] ?? '';

            $por_pagina = $parametros['por_pagina'] ?? 10;

            $vagas = DB::table('vagas')
                ->join('users', 'vagas.user_id', '=', 'users.id')
                ->select('vagas.*', 'users.name as user')
                ->whereNull('deleted_at');

            if (!empty($cep)) {
                $vagas = $vagas->where('cep', '=', $cep);
            }

            if (!empty($remuneracao)) {
                $vagas = $vagas->where('remuneracao', '=', $remuneracao);
            }

            if (!empty($descricao_curta)) {
                $vagas = $vagas->where('descricao_curta', 'like', $descricao_curta);
            }

            if (!empty($descricao_longa)) {
                $vagas = $vagas->where('descricao_longa', 'like', $descricao_longa);
            }

            $vagas = $vagas->orderBy('created_at', 'desc')->paginate($por_pagina);

            $parametros_url = [
                'previous' => $vagas->previousPageUrl(),
                'next' => $vagas->nextPageUrl(),
            ];

            $vagas = $vagas->map(function ($vaga) {
                return [
                    'id' => $vaga->id,
                    'descricao_curta' => $vaga->descricao_curta,
                    'descricao_longa' => $vaga->descricao_longa,
                    'remuneracao' => $this->formatar("dinheiro", $vaga->remuneracao),
                    'cep' => $vaga->cep,
                    'user' => $vaga->user,
                ];
            });

            return response()->json([
                'data' => $vagas,
                'pages' => $parametros_url,
            ]);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

    public function store(CreateRequest $request): JsonResponse
    {
        $dados = $request->only('descricao_curta', 'descricao_longa', 'remuneracao', 'cep', 'user_id');

        try {
            $vaga = Vaga::create($dados);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        return response()->json(['data' => $vaga]);
    }

    public function show(string $id): JsonResponse
    {
        try {
            $vaga = Vaga::findOrFail($id);

            return response()->json(['data' => [
                'id' => $vaga->id,
                'descricao_curta' => $vaga->descricao_curta,
                'descricao_longa' => $vaga->descricao_longa,
                'remuneracao' => $this->formatar("dinheiro", $vaga->remuneracao),
                'cep' => $this->formatar("cep", $vaga->cep),
                'user' => $vaga->user
            ]]);

        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $dados = $request->only('descricao_curta', 'descricao_longa', 'remuneracao', 'cep', 'user_id');

        try {
            $vaga = Vaga::findOrFail($id);
            $vaga->update($dados);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }

        return response()->json(['data' => $vaga]);
    }

    public function destroy(string $id): JsonResponse
    {
        try {

            $vaga = Vaga::findOrFail($id);
            $vaga->delete();

            return response()->json(['Vaga excluída com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()]);
        }
    }
}
