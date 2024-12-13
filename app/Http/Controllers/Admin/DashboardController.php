<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'totalPatients' => 0, // We'll implement these counts later
            'totalDentists' => 0,
            'totalAppointments' => 0
        ]);
    }
} 