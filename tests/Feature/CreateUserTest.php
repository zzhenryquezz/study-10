<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_create_a_user(): void
    {

        $payload = [
            'name' => 'John Doe',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/api/sign-up', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => $payload['name'],
            'email' => $payload['email'],
        ]);
    }
}
