<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodosController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $pagination = $user->todos()->paginate(10);

        return response()->json($pagination, 200);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'title' => 'required|string',
        ]);

        $payload['user_id'] = Auth::id();

        $user = User::find(Auth::id());

        $todo = $user->todos()->create($payload);

        return response()->json(['message' => 'Todo created successfully', 'data' => $todo], 200);
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'title' => 'required|string',
        ]);

        $user = User::find(Auth::id());

        $todo = $user->todos()->find($id);

        $todo->update($payload);

        return response()->json(['message' => 'Todo updated successfully', 'data' => $todo], 200);
    }

    public function destroy($id)
    {
        $user = User::find(Auth::id());

        $todo = $user->todos()->find($id);

        $todo->delete();

        return response()->json(['message' => 'Todo deleted successfully'], 200);
    }
}
