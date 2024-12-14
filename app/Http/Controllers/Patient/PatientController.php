<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(StorePatientRequest $request)
    {
        $role = auth()->user()->role;
        $patient = Patient::create($request->validated());
        return redirect()->route($role . '.patients.show', $patient)
            ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $patient->load(['appointments', 'treatmentRecords']);
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $role = auth()->user()->role;
        $patient->update($request->validated());
        return redirect()->route($role . '.patients.show', $patient)
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $role = auth()->user()->role;
        $patient->delete();
        return redirect()->route($role . '.patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
} 