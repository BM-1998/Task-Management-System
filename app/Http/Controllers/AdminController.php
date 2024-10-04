<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Task;

class AdminController extends Controller
{   
    public function getUsers() {
        $users = User::all();
        return response()->json([
            'message' => 'Data fetched successfully', 
            'data' => $users
        ]);
    }

    public function getAssignedToUsers() {
        $users = User::where('role', 'user') // Filter users whose role is 'user'
                     ->select('id', 'name')  // Select only 'id' and 'name' columns
                     ->get();
    
        return response()->json([
            'message' => 'Data fetched successfully', 
            'data' => $users
        ]);
    }
    

    public function getUserById($id){
        $user = User::findOrFail($id);
        // $user->delete();
        return response()->json(['message' => 'User fetched successfully', 'data'=> $user]);
    }

    public function getTasks()
    {
        $tasks = Task::with(['assignedTo:id,name', 'createdBy:id,name'])->get();

        return response()->json([
            'message' => 'Data fetched successfully',
            'data' => $tasks
        ]);
    }

    
    public function getStatistics() {
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'completed')->count();
        $totalUsers = User::count();

        return response()->json([
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'total_users' => $totalUsers
        ]);
    }

    // Manage users (CRUD)
    public function addUser(Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:6',
                'role' => 'required|string|in:admin,user'
            ]);
    
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role' => $validated['role']
            ]);
    
            return response()->json([
                'message' => 'User created successfully',
                'user' => $user
            ], 201);
            
        } catch (ValidationException $e) {
            // Log the validation error
            \Log::error('Validation failed for user creation:', $e->errors());
            
            // Return the validation error response
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }
    }
    

    public function editUser(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));
        return response()->json(['message' => 'User updated successfully']);
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    // Manage tasks (CRUD)
    public function addTask(Request $request) {
        try {
            // $title = $request->title; 
            // $description = $request->description;
            // $userId = $request->user_id;
            // dd($title);
            $validated = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'assigned_to' => 'required|exists:users,id',
                'created_by' => 'required|exists:users,id',
                'priority' => 'required'
            ]);
    
            Task::create($validated);
            return response()->json(['message' => 'Task created successfully']);
        }catch (ValidationException $e) {
            // Log the validation error
            \Log::error('Validation failed for user creation:', $e->errors());
            
            // Return the validation error response
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        }

       
    }

    public function editTask(Request $request, $id) {
        $task = Task::findOrFail($id);
        $task->update($request->only(['title', 'description']));
        return response()->json(['message' => 'Task updated successfully']);
    }

    public function deleteTask($id) {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
