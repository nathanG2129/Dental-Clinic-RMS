<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'dentist']);

        // Search by patient or dentist name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('patient', function($q) use ($search) {
                    $q->where('patient_name', 'like', "%{$search}%");
                })->orWhereHas('dentist', function($q) use ($search) {
                    $q->where('dentist_name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('appointment_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('appointment_date', '<=', $request->end_date);
        }

        // Filter by time range
        if ($request->filled('start_time')) {
            $query->whereTime('appointment_date', '>=', $request->start_time);
        }
        if ($request->filled('end_time')) {
            $query->whereTime('appointment_date', '<=', $request->end_time);
        }

        // Filter by purpose
        if ($request->filled('purpose')) {
            $query->where('purpose_of_appointment', 'like', "%{$request->purpose}%");
        }

        $appointments = $query->latest()->paginate(10)->withQueryString();
        
        // Get statuses for dropdown
        $statuses = ['scheduled', 'completed', 'cancelled'];
        
        return view('appointments.index', compact('appointments', 'statuses'));
    }

    public function create()
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        return view('appointments.create', compact('patients', 'dentists'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $role = auth()->user()->role;
        
        try {
            // Get validated data
            $data = $request->validated();
            
            // Combine date and time
            $appointmentDateTime = Carbon::parse($data['appointment_date'])->format('Y-m-d') . ' ' . $data['appointment_time'];
            
            // Create appointment data array
            $appointmentData = [
                'patient_id' => $data['patient_id'],
                'dentist_id' => $data['dentist_id'],
                'appointment_date' => $appointmentDateTime,
                'purpose_of_appointment' => $data['purpose_of_appointment'],
                'status' => 'scheduled',
                'notes' => $data['notes'] ?? null
            ];
            
            $appointment = Appointment::create($appointmentData);
            
            return redirect()->route($role . '.appointments.show', $appointment)
                ->with('success', 'Appointment scheduled successfully.');
                
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to schedule appointment. Please try again.');
        }
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient', 'dentist']);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        return view('appointments.edit', compact('appointment', 'patients', 'dentists'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $role = auth()->user()->role;
        $appointment->update($request->validated());
        return redirect()->route($role . '.appointments.show', $appointment)
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $role = auth()->user()->role;
        $appointment->delete();
        return redirect()->route($role . '.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
} 