<?php

namespace Tests\Unit\Users\Auth;

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
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token, 'Accept' => 'application/json'])->postJson(route("api.auth.logout"));

        $response->assertStatus(200)
            ->assertJsonStructure([
                "message",
            ]);
    }
}