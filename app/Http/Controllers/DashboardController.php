<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.template', ['title' => 'dashboard', 'posts' => []]);
    }

    public function credits()
    {
        return view('dashboard.credits', ['title' => 'credits']);
    }
}
