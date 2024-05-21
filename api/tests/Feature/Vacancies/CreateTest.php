<?php

namespace Tests\Feature\Vacancies;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * Testar endpoint de criação de vagas
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testCreateVacancies(): void
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . Cache::get("token_php_unit"), 'Accept' => 'application/json'])->postJson(env('APP_URL') . '/api/vacancies', [
            'short_description' => 'Exemplo com php unit',
            'long_description' => 'Exemplo gerado com phpunit de longas descrições',
            'wage' => '120000',
            'zip_code' => '11674771',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data"
            ]);
    }
}
