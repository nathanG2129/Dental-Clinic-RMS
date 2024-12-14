<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\TreatmentRecord;
use App\Models\Dentist;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $dentist = $user->dentist;

        // If dentist record doesn't exist, create it
        if (!$dentist) {
            $dentist = Dentist::create([
                'name' => $user->name,
                'user_id' => $user->id,
                'specialization' => 'General Dentistry',
                'contact_information' => $user->email,
            ]);
        }
        
        $todayAppointments = Appointment::with('patient')
            ->where('dentist_id', $dentist->id)
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_date')
            ->get();

        $totalPatients = $dentist->appointments()
            ->distinct('patient_id')
            ->count('patient_id');

        $completedTreatments = $dentist->treatmentRecords()
            ->count();

        $recentTreatments = $dentist->treatmentRecords()
            ->with('patient')
            ->latest()
            ->take(5)
            ->get();

        return view('dentist.dashboard', compact(
            'todayAppointments',
            'totalPatients',
            'completedTreatments',
            'recentTreatments'
        ));
    }
} 