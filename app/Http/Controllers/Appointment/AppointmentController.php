<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'dentist'])
            ->latest()
            ->paginate(10);
        return view('appointments.index', compact('appointments'));
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
        
        // Combine date and time into appointment_date
        $appointmentData = $request->validated();
        $appointmentData['appointment_date'] = $request->appointment_date . ' ' . $request->appointment_time;
        unset($appointmentData['appointment_time']); // Remove separate time field
        
        $appointment = Appointment::create($appointmentData);
        return redirect()->route($role . '.appointments.show', $appointment)
            ->with('success', 'Appointment created successfully.');
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
        $appointment->update($request->validated());
        return redirect()->route('appointments.show', $appointment)
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
} 