<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTodoTest extends TestCase
{
    use DatabaseMigrations;

    public function test_create_tod(): void
    {
        $user = User::factory()->create();

        $payload = ['title' => 'Test todo'];

        $response = $this->actingAs($user)->post('/api/todos', $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('todos', $payload);
    }
}
