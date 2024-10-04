<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard(){
        return view('dashboard');
    }
    public function showUsers(){
        return view('users');
    }
    public function showTasks(){
        return view('tasks');
    }
}
