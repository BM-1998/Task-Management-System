<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginPage']);

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware('auth:sanctum');
Route::get('/users', [DashboardController::class, 'showUsers']);
Route::get('/tasks', [DashboardController::class, 'showTasks']);
