<?php

namespace App\Http\Controllers\TreatmentRecord;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreatmentRecord\StoreTreatmentRecordRequest;
use App\Http\Requests\TreatmentRecord\UpdateTreatmentRecordRequest;
use App\Models\TreatmentRecord;
use App\Models\Patient;
use App\Models\Dentist;
use Illuminate\Http\Request;

class TreatmentRecordController extends Controller
{
    public function index()
    {
        $treatmentRecords = TreatmentRecord::with(['patient', 'dentist'])
            ->latest()
            ->paginate(10);
        return view('treatment-records.index', compact('treatmentRecords'));
    }

    public function create()
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        return view('treatment-records.create', compact('patients', 'dentists'));
    }

    public function store(StoreTreatmentRecordRequest $request)
    {
        $role = auth()->user()->role;
        $treatmentRecord = TreatmentRecord::create($request->validated());
        return redirect()->route($role . '.treatment-records.show', $treatmentRecord)
            ->with('success', 'Treatment record created successfully.');
    }

    public function show(TreatmentRecord $treatmentRecord)
    {
        $treatmentRecord->load(['patient', 'dentist']);
        return view('treatment-records.show', compact('treatmentRecord'));
    }

    public function edit(TreatmentRecord $treatmentRecord)
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        return view('treatment-records.edit', compact('treatmentRecord', 'patients', 'dentists'));
    }

    public function update(UpdateTreatmentRecordRequest $request, TreatmentRecord $treatmentRecord)
    {
        $role = auth()->user()->role;
        $treatmentRecord->update($request->validated());
        return redirect()->route($role . '.treatment-records.show', $treatmentRecord)
            ->with('success', 'Treatment record updated successfully.');
    }

    public function destroy(TreatmentRecord $treatmentRecord)
    {
        $role = auth()->user()->role;
        $treatmentRecord->delete();
        return redirect()->route($role . '.treatment-records.index')
            ->with('success', 'Treatment record deleted successfully.');
    }
} 