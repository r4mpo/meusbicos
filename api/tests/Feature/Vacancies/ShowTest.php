<?php

namespace Tests\Feature\Vacancies;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ShowTest extends TestCase
{
    /**
     * Testar endpoint de pesquisa individual de vagas
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testShowVacancies(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . Cache::get("token_php_unit"), 
            'Accept' => 'application/json'
        ])->getJson(env('APP_URL') . '/api/vacancies/' . Cache::get('vacancy_id_php_unit'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data"
        ]);
    }
}