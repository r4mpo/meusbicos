<?php

namespace Tests\Unit\Users\Auth;

use Tests\TestCase;

class RefreshTest extends TestCase
{
    /**
     * Recria o token de um usuário logado
     * Neste endpoint, faz-se necessário passar o token
     * 
     * @return void
     */
    public function testRefresh(): void
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token, 'Accept' => 'application/json'])->postJson(route("api.auth.refresh"));

        $response->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);
    }
}