<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use Carbon\Carbon;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name' => 'John Smith',
                'dob' => '1985-03-15',
                'gender' => 'male',
                'address' => '123 Main St, Anytown, ST 12345',
            ],
            [
                'name' => 'Sarah Johnson',
                'dob' => '1990-07-22',
                'gender' => 'female',
                'address' => '456 Oak Ave, Somewhere, ST 12346',
            ],
            [
                'name' => 'Michael Brown',
                'dob' => '1978-11-30',
                'gender' => 'male',
                'address' => '789 Pine Rd, Elsewhere, ST 12347',
            ],
            [
                'name' => 'Emily Davis',
                'dob' => '1995-04-18',
                'gender' => 'female',
                'address' => '321 Elm St, Nowhere, ST 12348',
            ],
            [
                'name' => 'David Wilson',
                'dob' => '1982-09-25',
                'gender' => 'male',
                'address' => '654 Maple Dr, Anywhere, ST 12349',
            ],
            [
                'name' => 'Jennifer Taylor',
                'dob' => '1988-06-12',
                'gender' => 'female',
                'address' => '987 Cedar Ln, Someplace, ST 12350',
            ],
            [
                'name' => 'Robert Anderson',
                'dob' => '1975-12-05',
                'gender' => 'male',
                'address' => '147 Birch Blvd, Othertown, ST 12351',
            ],
            [
                'name' => 'Lisa Martinez',
                'dob' => '1992-02-28',
                'gender' => 'female',
                'address' => '258 Spruce Ct, Elsewhere, ST 12352',
            ],
            [
                'name' => 'William Thompson',
                'dob' => '1980-08-14',
                'gender' => 'male',
                'address' => '369 Willow Way, Somewhere, ST 12353',
            ],
            [
                'name' => 'Jessica White',
                'dob' => '1993-01-20',
                'gender' => 'female',
                'address' => '741 Aspen Ave, Anytown, ST 12354',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create([
                'patient_name' => $patient['name'],
                'date_of_birth' => $patient['dob'],
                'gender' => $patient['gender'],
                'contact_information' => '+1 (555) ' . rand(100, 999) . '-' . rand(1000, 9999),
                'address' => $patient['address'],
            ]);
        }
    }
} 