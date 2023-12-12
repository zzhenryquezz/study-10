<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyTodoTest extends TestCase
{
    use DatabaseMigrations;

    public function test_delete_a_todo(): void
    {
        $user = User::factory()->create();

        $todo = $user->todos()->create(['title' => 'Test todo']);

        $response = $this->actingAs($user)->delete('/api/todos/' . $todo->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
        
    }
}
