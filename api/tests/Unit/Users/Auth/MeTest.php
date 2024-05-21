<?php

namespace Tests\Unit\Users\Auth;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class MeTest extends TestCase
{
    /**
     * Capturando dados de um usuário logado
     * Neste endpoint, faz-se necessário passar o token
     * 
     * @return void
    */
    public function testGetInfoUserAuth(): void
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . Cache::get("token_php_unit"), 'Accept' => 'application/json'])->postJson(route("api.auth.me"));

        $response->assertStatus(200)
            ->assertJsonStructure([
                "id",
                "name",
                "email",
                "email_verified_at",
                "created_at",
                "updated_at",
            ]);
    }
}