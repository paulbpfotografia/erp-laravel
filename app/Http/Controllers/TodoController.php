<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        Auth::user()->todos()->create([
            'task' => $request->task,
        ]);

        return back();
    }

    public function toggle($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->completed = !$todo->completed;
        $todo->save();

        return back();
    }

    public function destroy($id)
    {
        $todo = Auth::user()->todos()->findOrFail($id);
        $todo->delete();

        return back();
    }
}
