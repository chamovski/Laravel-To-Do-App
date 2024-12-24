<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Task; 

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
    ]);

    // Create a new task with only the validated data
    Task::create($request->only(['title', 'description']));

    // Redirect to the task list
    return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
}


    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
    public function complete(Task $task)
    {
    $task->update(['completed' => true]);
    return redirect()->route('tasks.index');
    }

    public function markAsCompleted(Task $task)
    {
    $task->update(['is_completed' => true]);
    return redirect()->route('tasks.index')->with('success', 'Task marked as completed!');
    }


}
