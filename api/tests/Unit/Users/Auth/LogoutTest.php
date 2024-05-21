<?php

namespace Tests\Unit\Users\Auth;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * Desconecta um usuário logado
     * Neste endpoint, faz-se necessário passar o token
     * 
     * @return void
    */
    public function testLogout(): void
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . Cache::get("token_php_unit"), 'Accept' => 'application/json'])->postJson(route("api.auth.logout"));

        $response->assertStatus(200)
            ->assertJsonStructure([
                "message",
            ]);
    }
}