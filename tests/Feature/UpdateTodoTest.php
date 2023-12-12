<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTodoTest extends TestCase
{
    
    use DatabaseMigrations;

    public function test_update_todo(): void
    {
        $user = User::factory()->create();

        $todo = Todo::factory()->state(['user_id' => $user->id])->create();

        $payload = ['title' => 'Updated todo'];

        $response = $this->actingAs($user)->put('/api/todos/' . $todo->id, $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('todos', $payload);
    }
}
