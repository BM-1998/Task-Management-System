<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// Route::middleware('auth:sanctum')->group(function () {
//     // Admin routes
//     Route::middleware('can:admin')->group(function () {
//         Route::get('admin/statistics', [AdminController::class, 'getStatistics']);
//         Route::post('admin/users', [AdminController::class, 'addUser']);
//         Route::put('admin/users/{id}', [AdminController::class, 'editUser']);
//         Route::delete('admin/users/{id}', [AdminController::class, 'deleteUser']);

//         Route::post('admin/tasks', [AdminController::class, 'addTask']);
//         Route::put('admin/tasks/{id}', [AdminController::class, 'editTask']);
//         Route::delete('admin/tasks/{id}', [AdminController::class, 'deleteTask']);
//     });

//     // User routes
//     Route::get('user/tasks', [UserController::class, 'viewTasks']);
//     Route::put('user/tasks/{id}', [UserController::class, 'updateTaskStatus']);
// });
Route::middleware(['auth:sanctum','api.auth'])->group(function () {
    // Admin routes
    Route::middleware(['auth:sanctum', 'admin'])->group(function () { // Use 'admin' middleware here
        Route::get('admin/statistics', [AdminController::class, 'getStatistics']);
        Route::post('admin/users', [AdminController::class, 'addUser']);
        Route::get('admin/users/{id}', [AdminController::class, 'getUserById']);
        Route::put('admin/users/{id}', [AdminController::class, 'editUser']);
        Route::delete('admin/users/{id}', [AdminController::class, 'deleteUser']);
        Route::get('admin/users', [AdminController::class, 'getUsers']);

        Route::post('admin/tasks', [AdminController::class, 'addTask']);
        Route::put('admin/tasks/{id}', [AdminController::class, 'editTask']);
        Route::delete('admin/tasks/{id}', [AdminController::class, 'deleteTask']);
        Route::get('admin/tasks', [AdminController::class, 'getTasks']);

        Route::get('admin/getAssignedToUsers', [AdminController::class, 'getAssignedToUsers']);

    });

    // User routes
    Route::get('user/tasks', [UserController::class, 'viewTasks']);
    Route::get('user/getStatisticsUser/{id}', [UserController::class, 'getStatisticsUser']);
    Route::get('user/getTaskUser/{id}', [UserController::class, 'getTaskUser']);
    Route::put('user/tasks/{id}', [UserController::class, 'updateTaskStatus']);
    Route::get('user/getTaskById/{id}', [UserController::class, 'getTaskById']);
    
});

