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
    public function index(Request $request)
    {
        $query = TreatmentRecord::with(['patient', 'dentist']);

        // Search by patient name or treatment type
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('patient', function($q) use ($search) {
                    $q->where('patient_name', 'like', "%{$search}%");
                })->orWhere('treatment_type', 'like', "%{$search}%");
            });
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('treatment_date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('treatment_date', '<=', $request->end_date);
        }

        // Filter by cost range
        if ($request->filled('min_cost')) {
            $query->where('cost', '>=', $request->min_cost);
        }
        if ($request->filled('max_cost')) {
            $query->where('cost', '<=', $request->max_cost);
        }

        // Filter by dentist
        if ($request->filled('dentist_id')) {
            $dentistId = $request->dentist_id;
            if ($dentistId !== '') {
                $query->where('dentist_id', (int)$dentistId);
            }
        }

        $treatmentRecords = $query->latest()->paginate(10)->withQueryString();
        
        // Get payment statuses and dentists for dropdowns
        $paymentStatuses = ['paid', 'pending', 'cancelled'];
        
        // Get dentists with proper ordering
        $dentists = Dentist::orderBy('dentist_name')
            ->select('dentist_id', 'dentist_name')
            ->get();
        
        // Debug information
        \Log::info('Request parameters:', [
            'dentist_id' => $request->dentist_id,
            'is_filled' => $request->filled('dentist_id'),
            'query_string' => $request->getQueryString()
        ]);
        
        return view('treatment-records.index', compact('treatmentRecords', 'paymentStatuses', 'dentists'));
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