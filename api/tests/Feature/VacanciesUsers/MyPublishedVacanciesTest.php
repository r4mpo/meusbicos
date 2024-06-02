<?php

namespace Tests\Feature\VacanciesUsers;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class MyPublishedVacanciesTest extends TestCase
{
    /**
     * Testar endpoint de pesquisa das vagas publicadas por um usuário
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testMyPublishedVacancies(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . Cache::get("token_php_unit"),
            'Accept' => 'application/json'
        ])->getJson(route('api.vacancies_user.my_published_vacancies'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data"
            ]);
    }
}
