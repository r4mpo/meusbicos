<?php

namespace Tests\Feature\Vacancies;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * Testar endpoint de pesquisa de vagas
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testSearchVacancies(): void
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . Cache::get("token_php_unit"), 'Accept' => 'application/json'])->getJson(env('APP_URL') . '/api/vacancies', [
            'short_description' => 'Exemplo com php unit',
            'long_description' => 'Exemplo gerado com phpunit de longas descrições',
            'wage' => '120000',
            'zip_code' => '11674771',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data",
                "pages"
            ]);
    }
}
