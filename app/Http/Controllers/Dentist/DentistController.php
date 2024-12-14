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
    public function index()
    {
        $dentists = Dentist::with('user')->latest()->paginate(10);
        return view('dentists.index', compact('dentists'));
    }

    public function create()
    {
        $users = User::where('role', 'dentist')
            ->whereDoesntHave('dentist')
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

        if (empty($users)) {
            return redirect()->route('admin.dentists.index')
                ->with('error', 'No available dentist user accounts. Please create a user account with dentist role first.');
        }

        return view('dentists.create', compact('users'));
    }

    public function store(StoreDentistRequest $request)
    {
        $role = auth()->user()->role;
        $dentist = Dentist::create([
            'dentist_name' => User::find($request->user_id)->name,
            'user_id' => $request->user_id,
            'specialization' => $request->specialization,
            'contact_information' => $request->contact_information,
        ]);
        
        return redirect()->route($role . '.dentists.show', $dentist)
            ->with('success', 'Dentist created successfully.');
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
            'dentist_name' => User::find($request->user_id)->name,
            'user_id' => $request->user_id,
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