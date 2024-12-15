<?php

namespace App\Http\Controllers\Dentist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dentist\StoreDentistRequest;
use App\Http\Requests\Dentist\UpdateDentistRequest;
use App\Models\Dentist;
use App\Models\User;
use Illuminate\Http\Request;

class DentistController extends Controller
{
    public function index(Request $request)
    {
        $query = Dentist::with('user');

        // Search by name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('dentist_name', 'like', "%{$search}%");
        }

        // Filter by specialization
        if ($request->filled('specialization')) {
            $query->where('specialization', $request->specialization);
        }

        // Filter by availability (based on appointments)
        if ($request->filled('available_date')) {
            $date = $request->available_date;
            $query->whereDoesntHave('appointments', function($q) use ($date) {
                $q->whereDate('appointment_date', $date)
                  ->where('status', 'scheduled');
            });
        }

        $dentists = $query->latest()->paginate(10)->withQueryString();
        
        // Get unique specializations for the filter dropdown
        $specializations = Dentist::distinct()->pluck('specialization');
        
        return view('dentists.index', compact('dentists', 'specializations'));
    }

    public function create()
    {
        return view('dentists.create');
    }

    public function store(StoreDentistRequest $request)
    {
        $role = auth()->user()->role;
        $dentist = Dentist::create([
            'dentist_name' => $request->dentist_name,
            'specialization' => $request->specialization,
            'contact_information' => $request->contact_information,
        ]);
        
        return redirect()->route($role . '.dentists.show', $dentist)
            ->with('success', 'Dentist information updated successfully.');
    }

    public function show(Dentist $dentist)
    {
        $dentist->load(['user', 'appointments', 'treatmentRecords']);
        return view('dentists.show', compact('dentist'));
    }

    public function edit(Dentist $dentist)
    {
        $users = User::where('role', 'dentist')
            ->where(function($query) use ($dentist) {
                $query->whereDoesntHave('dentist')
                    ->orWhere('id', $dentist->user_id);
            })
            ->orderBy('name')
            ->get(['id', 'name', 'email'])
            ->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name . ' (' . $user->email . ')'
                ];
            })
            ->pluck('name', 'id')
            ->toArray();

        return view('dentists.edit', compact('dentist', 'users'));
    }

    public function update(UpdateDentistRequest $request, Dentist $dentist)
    {
        $role = auth()->user()->role;
        $dentist->update([
            'dentist_name' => $request->dentist_name,
            'specialization' => $request->specialization,
            'contact_information' => $request->contact_information,
        ]);
        
        return redirect()->route($role . '.dentists.show', $dentist)
            ->with('success', 'Dentist updated successfully.');
    }

    public function destroy(Dentist $dentist)
    {
        $role = auth()->user()->role;
        $dentist->delete();
        return redirect()->route($role . '.dentists.index')
            ->with('success', 'Dentist deleted successfully.');
    }
} 