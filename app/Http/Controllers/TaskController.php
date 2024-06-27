<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,completed',
        ]);
        
         // Retrieve all validated request data
        $taskData = $request->all();

        // Add the authenticated user's ID to the task data
        $taskData['user_id'] = Auth::id();
      
        // Create a new task with the combined data
        $taskData = new Task();
        $taskData->title = $request->title;
        $taskData->description = $request->description;
        $taskData->status = $request->status;
        $taskData->user_id = Auth::id();
        $taskData->save();

        return redirect('dashboard')->with('success', 'Task created successfully.');
    }

    public function edit($task_id)
    {
        $task = Task::find($task_id);
        return view('edit', compact('task'));
    }

    public function update(Request $request, $task_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:pending,completed',
        ]);
         $taskData = Task::find($task_id);          
        $taskData->title = $request->title;
        $taskData->description = $request->description;
        $taskData->status = $request->status;
        $taskData->save();

        return redirect('dashboard')->with('success', 'Task updated successfully.');
    }

    public function destroy($task_id)
    {
      $task =  Task::find($task_id);
        if($task){
        $task->delete();
        }
        return back();
        
    }
}
