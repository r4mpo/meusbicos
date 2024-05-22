<?php

namespace Tests\Feature\Vacancies;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /**
     * Testar endpoint exclusão de vagas
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testDeleteVacancies(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . Cache::get("token_php_unit"),
            'Accept' => 'application/json'
        ])->deleteJson(env('APP_URL') . '/api/vacancies/' . Cache::get('vacancy_id_php_unit'));

        $response->assertStatus(200)
            ->assertJson([
                "vacancy successfully deleted"
            ]);
    }
}
