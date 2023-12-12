<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTodoTest extends TestCase
{
    use DatabaseMigrations;
    
    public function test_list_todos(): void
    {
        $user = User::factory()->create();

        Todo::factory()->state(['user_id' => $user->id])->count(5)->create();

        $pagination = $user->todos()->paginate(10);
        
        $pagination->setPath(env('APP_URL') . '/api/todos');

        $response = $this->actingAs($user)->get('/api/todos');

        $response->assertStatus(200);

        $response->assertJsonFragment($pagination->toArray());
        
    }
}
