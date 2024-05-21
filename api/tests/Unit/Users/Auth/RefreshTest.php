<?php

namespace Tests\Unit\Users\Auth;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;

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
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . Cache::get("token_php_unit"), 'Accept' => 'application/json'])->postJson(route("api.auth.refresh"));

        $response->assertStatus(200)
            ->assertJsonStructure([
                "access_token",
                "token_type",
                "expires_in"
            ]);

        $result = $response->json();
        Cache::put('token_php_unit', $result["access_token"], now()->addMinutes(1));
    }
}
