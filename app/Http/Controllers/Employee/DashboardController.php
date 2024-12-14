<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $todayAppointments = Appointment::with(['patient', 'dentist'])
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_date')
            ->get();

        $totalPatients = Patient::count();

        $recentPatients = Patient::latest()
            ->take(5)
            ->get();

        return view('employee.dashboard', compact(
            'todayAppointments',
            'totalPatients',
            'recentPatients'
        ));
    }
} 