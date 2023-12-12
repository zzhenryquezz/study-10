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
}
