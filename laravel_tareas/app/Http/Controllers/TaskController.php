<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tareas = Task::where('usuario_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tareas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        Task::create([
            'usuario_id' => Auth::id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estado' => 'Pendiente',
        ]);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        if ($task->usuario_id !== Auth::id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->usuario_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
        ]);

        $task->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        if ($task->usuario_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function updateStatus(Request $request, Task $task)
    {
        if ($task->usuario_id !== Auth::id()) {
            return response()->json(['success' => false], 403);
        }

        $request->validate([
            'estado' => 'required|in:Pendiente,En Progreso,Completada'
        ]);

        $task->update(['estado' => $request->estado]);

        return response()->json(['success' => true]);
    }
}
