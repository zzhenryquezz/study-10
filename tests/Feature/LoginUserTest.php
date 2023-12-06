<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_login(): void
    {

        $payload = [
            'email' => 'test@teste.com',
            'password' => 'password123',
        ];

        User::factory()->create($payload);

        $response = $this->post('/api/login', $payload);

        $response->assertStatus(200);

        $response->assertJsonStructure(['token']);
    }
}
