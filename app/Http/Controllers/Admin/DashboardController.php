<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Dentist;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalDentists = Dentist::count();
        $totalAppointments = Appointment::count();
        $todayAppointments = Appointment::whereDate('appointment_date', today())->count();

        $recentAppointments = Appointment::with(['patient', 'dentist'])
            ->latest()
            ->take(5)
            ->get();

        $recentPatients = Patient::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPatients',
            'totalDentists',
            'totalAppointments',
            'todayAppointments',
            'recentAppointments',
            'recentPatients'
        ));
    }
} 