<?php namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
    public function index() {
        return response()->json(Task::latest()->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,in_progress,done'
        ]);
        return response()->json(Task::create($data), 201);
    }

    public function update(Request $request, Task $task) {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:pending,in_progress,done'
        ]);
        $task->update($data);
        return response()->json($task);
    }

    public function destroy(Task $task) {
        $task->delete();
        return response()->json(null, 204);
    }
}