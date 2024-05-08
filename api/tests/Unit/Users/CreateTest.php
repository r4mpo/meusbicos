<?php

namespace Tests\Unit\Users;

use Tests\TestCase;

class CreateTest extends TestCase
{
    /**
     * Testar endpoint de criação de usuários
     * Neste, em específico, passamos dados válidos
     * Espera-se o retorno positivo
     * 
     * @return void
     */
    public function testCreateUsersWithValidFields(): void
    {
        $response = $this->postJson(route("api.auth.create"), [
            'name' => 'PHPUnit User',
            'email' => 'user_phpunit@example.com',
            'password' => 'usertEsfww12312dat3#_!.G',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user',
                'data',
                'message',
                'success',
            ]);
    }


    /**
     * Testar endpoint de criação de usuários
     * Neste, em específico, passamos dados inválidos
     * Espera-se o retorno negativo
     * 
     * @return void
     */
    public function testCreateUsersWithInvalidFields(): void
    {
        $response = $this->postJson(route("api.auth.create"), [
            'name' => 'PHPUnit User',
            'email' => 'user_phpunit',
            'password' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors',
            ]);
    }
}