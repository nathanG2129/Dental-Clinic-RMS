<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dentist.dashboard', [
            'title' => 'Dentist Dashboard',
            'myAppointments' => [], // We'll implement these later
            'myPatients' => [],
            'recentTreatments' => []
        ]);
    }
} 