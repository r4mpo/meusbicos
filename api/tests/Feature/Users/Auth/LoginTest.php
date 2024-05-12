<?php

namespace Tests\Feature\Auth\Users;

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
        $response = $this->postJson(route("api.auth.login"), [
            'email' => 'user_phpunit@example.com',
            'password' => 'usertEsfww12312dat3#_!.G',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
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