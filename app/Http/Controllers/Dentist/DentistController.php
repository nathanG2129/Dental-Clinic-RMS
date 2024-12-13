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
        $users = User::where('role', 'dentist')->whereDoesntHave('dentist')->get();
        return view('dentists.create', compact('users'));
    }

    public function store(StoreDentistRequest $request)
    {
        $dentist = Dentist::create($request->validated());
        return redirect()->route('dentists.show', $dentist)
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
            })->get();
        return view('dentists.edit', compact('dentist', 'users'));
    }

    public function update(UpdateDentistRequest $request, Dentist $dentist)
    {
        $dentist->update($request->validated());
        return redirect()->route('dentists.show', $dentist)
            ->with('success', 'Dentist updated successfully.');
    }

    public function destroy(Dentist $dentist)
    {
        $dentist->delete();
        return redirect()->route('dentists.index')
            ->with('success', 'Dentist deleted successfully.');
    }
} 