<?php

namespace Tests\Feature\Vacancies;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class EditTest extends TestCase
{
    /**
     * Testar endpoint de edição de vagas
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testEditVacancies(): void
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . Cache::get("token_php_unit"), 'Accept' => 'application/json'])->putJson(env('APP_URL') . '/api/vacancies/' . Cache::get('vacancy_id_php_unit'), [
            'short_description' => 'Editado com php unit',
            'long_description' => 'Exemplo editado gerado com phpunit de longas descrições'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data"
        ]);
    }
}