<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class UserController extends Controller
{
     // View tasks for the logged-in user
     public function viewTasks(Request $request) {
        $tasks = Task::where('user_id', $request->user()->id)->get();
        return response()->json($tasks);
    }

    // Update task status
    public function updateTaskStatus(Request $request, $id) {
        $task = Task::findOrFail($id);
        $task->update(['status' => $request->status]);
        return response()->json(['message' => 'Task status updated successfully']);
    }

    public function getStatisticsUser($id) {
        $userId = $id; // Get the logged-in user's ID
    
        $totalTasks = Task::where('assigned_to', $userId)->count();
        $completedTasks = Task::where('assigned_to', $userId)
                              ->where('status', 'completed')
                              ->count();
    
        return response()->json([
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
        ]);
    }

    public function getTaskUser($id)
    {
        $userId = $id; // Get the logged-in user's ID
    
        // Fetch tasks assigned to the user with associated user details
        $tasks = Task::with(['assignedTo:id,name', 'createdBy:id,name'])
                    ->where('assigned_to', $userId)
                    ->get();

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $tasks
        ]);
    }

    public function getTaskById($id){
        $user = Task::findOrFail($id);
        return response()->json(['message' => 'User fetched successfully', 'data'=> $user]);
    }
}
