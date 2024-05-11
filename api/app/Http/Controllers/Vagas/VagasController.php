<?php

namespace App\Http\Controllers\Vagas;

use App\Http\Controllers\Controller;
use App\Models\Vagas\Vaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VagasController extends Controller
{
    /**
     * Retorna todas vagas
     */
    public function index() // query param optional: ?page=X (x = number page)
    {
        try {
            $parametros = request();

            $cep = $parametros['cep'] ? preg_replace('/\D/', '', $parametros['cep']) : '';
            $remuneracao = $parametros['remuneracao'] ? preg_replace('/\D/', '', $parametros['remuneracao']) : '';

            $descricao_curta = $parametros['descricao_curta'] ?? '';
            $descricao_longa = $parametros['descricao_longa'] ?? '';

            $por_pagina = $parametros['por_pagina'] ?? 10;
            $pagina = $parametros['pagina'] ?? 1;

            $vagas = DB::table('vagas')
                ->join('users', 'vagas.user_id', '=', 'users.id')
                ->select('vagas.*', 'users.name as user');

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
                    'remuneracao' => 'R$' . number_format($vaga->remuneracao, 2, ",", ""),
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
