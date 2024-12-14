<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dentist;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:dentist,employee'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // If registering as a dentist, create dentist record
        if ($request->role === 'dentist') {
            Dentist::create([
                'dentist_name' => $request->name,
                'user_id' => $user->id,
                'specialization' => 'General Dentistry', // Default value
                'contact_information' => $request->email, // Using email as initial contact
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        switch ($user->role) {
            case 'dentist':
                return redirect()->route('dentist.dashboard');
            case 'employee':
                return redirect()->route('employee.dashboard');
            default:
                return redirect('/');
        }
    }
}
