<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'patient_name' => 'John Smith',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'contact_information' => '(555) 123-4567',
                'address' => '123 Main St, Anytown, ST 12345',
            ],
            [
                'patient_name' => 'Sarah Johnson',
                'date_of_birth' => '1985-08-22',
                'gender' => 'female',
                'contact_information' => '(555) 234-5678',
                'address' => '456 Oak Ave, Somewhere, ST 12346',
            ],
            [
                'patient_name' => 'Michael Brown',
                'date_of_birth' => '1995-03-10',
                'gender' => 'male',
                'contact_information' => '(555) 345-6789',
                'address' => '789 Pine Rd, Elsewhere, ST 12347',
            ],
            [
                'patient_name' => 'Emily Davis',
                'date_of_birth' => '1992-11-28',
                'gender' => 'female',
                'contact_information' => '(555) 456-7890',
                'address' => '321 Elm St, Nowhere, ST 12348',
            ],
            [
                'patient_name' => 'David Wilson',
                'date_of_birth' => '1988-07-04',
                'gender' => 'male',
                'contact_information' => '(555) 567-8901',
                'address' => '654 Maple Dr, Anywhere, ST 12349',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
} 