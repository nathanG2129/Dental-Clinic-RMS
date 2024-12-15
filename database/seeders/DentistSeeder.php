<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dentist;
use App\Models\User;

class DentistSeeder extends Seeder
{
    public function run(): void
    {
        $dentistSpecializations = [
            'Dr. John Smith' => 'General Dentistry',
            'Dr. Sarah Johnson' => 'Orthodontics',
            'Dr. Michael Brown' => 'Periodontics',
            'Dr. Emily Davis' => 'Endodontics',
            'Dr. David Wilson' => 'Oral Surgery',
        ];

        foreach ($dentistSpecializations as $name => $specialization) {
            $user = User::where('name', $name)->first();
            
            if ($user) {
                Dentist::create([
                    'dentist_name' => $name,
                    'specialization' => $specialization,
                    'contact_information' => '+1 (555) ' . rand(100, 999) . '-' . rand(1000, 9999),
                    'user_id' => $user->id,
                ]);
            }
        }
    }
} 