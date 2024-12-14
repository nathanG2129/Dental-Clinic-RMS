<?php

namespace Database\Seeders;

use App\Models\Dentist;
use App\Models\User;
use Illuminate\Database\Seeder;

class DentistSeeder extends Seeder
{
    public function run(): void
    {
        $dentistUsers = User::where('role', 'dentist')->get();

        foreach ($dentistUsers as $user) {
            Dentist::create([
                'dentist_name' => $user->name,
                'user_id' => $user->id,
                'specialization' => ['General Dentistry', 'Orthodontics', 'Periodontics'][rand(0, 2)],
                'contact_information' => '(555) ' . rand(100, 999) . '-' . rand(1000, 9999),
            ]);
        }
    }
} 