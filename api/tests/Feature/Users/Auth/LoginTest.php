<?php

namespace Tests\Feature\Auth\Users;

use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Testar o endpoint de login com credenciais válidas.
     *
     * @return void
     */
    public function testLoginWithValidCredentials(): void
    {
        $response = $this->postJson(route("api.auth.login"), Cache::get("user_php_unit"));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);

        $result = $response->json();

        Cache::put('token_php_unit', $result["access_token"]);
    }

    /**
     * Testar o endpoint de login com credenciais inválidas.
     *
     * @return void
     */
    public function testLoginWithInvalidCredentials(): void
    {
        $response = $this->postJson(route("api.auth.login"), [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'error' => 'Not authorized.',
            ]);
    }
}
