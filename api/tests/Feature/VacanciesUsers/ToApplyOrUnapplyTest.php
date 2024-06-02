<?php

namespace Tests\Feature\VacanciesUsers;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ToApplyOrUnapplyTest extends TestCase
{
    /**
     * Testar endpoint para aplicar a uma vaga
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testToApply(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . Cache::get("token_php_unit"),
            'Accept' => 'application/json'
        ])->getJson(route('api.vacancies_user.to_apply_or_unapply', [
            'vacancy_id' => '1', // testamos com a primeira vaga criada pelos seed
            'action' => 'attach'
        ]));

        $response->assertStatus(200)
            ->assertJson([
                'user PHPUnit User 2 applied to Desenvolvimento de site institucional'
            ]);
    }

    /**
     * Testar endpoint para desaplicar a uma vaga
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testToUnapply(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . Cache::get("token_php_unit"),
            'Accept' => 'application/json'
        ])->getJson(route('api.vacancies_user.to_apply_or_unapply', [
            'vacancy_id' => '1', // testamos com a primeira vaga criada pelos seed
            'action' => 'detach'
        ]));

        $response->assertStatus(200)
            ->assertJson([
                'user PHPUnit User 2 disappointed to Desenvolvimento de site institucional'
            ]);
    }
}
