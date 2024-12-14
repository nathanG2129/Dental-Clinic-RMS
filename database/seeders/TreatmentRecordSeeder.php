<?php

namespace Database\Seeders;

use App\Models\TreatmentRecord;
use Illuminate\Database\Seeder;

class TreatmentRecordSeeder extends Seeder
{
    public function run(): void
    {
        $treatments = [
            [
                'patient_id' => 1,
                'dentist_id' => 1,
                'treatment_type' => 'Regular Checkup',
                'treatment_details' => 'Routine dental examination and cleaning',
                'treatment_date' => '2024-01-19',
                'cost' => 150.00,
                'payment_status' => 'paid',
                'notes' => 'No cavities found'
            ],
            [
                'patient_id' => 2,
                'dentist_id' => 1,
                'treatment_type' => 'Cavity Filling',
                'treatment_details' => 'Composite filling on upper right molar',
                'treatment_date' => '2024-01-19',
                'cost' => 250.00,
                'payment_status' => 'pending',
                'notes' => 'Follow-up in 6 months'
            ],
            [
                'patient_id' => 3,
                'dentist_id' => 2,
                'treatment_type' => 'Root Canal',
                'treatment_details' => 'Root canal treatment on lower left premolar',
                'treatment_date' => '2024-01-18',
                'cost' => 800.00,
                'payment_status' => 'partially_paid',
                'notes' => 'Patient paid $400, remainder due next visit'
            ],
            [
                'patient_id' => 4,
                'dentist_id' => 2,
                'treatment_type' => 'Teeth Whitening',
                'treatment_details' => 'Professional in-office whitening treatment',
                'treatment_date' => '2024-01-17',
                'cost' => 350.00,
                'payment_status' => 'paid',
                'notes' => 'Achieved desired shade'
            ],
            [
                'patient_id' => 5,
                'dentist_id' => 3,
                'treatment_type' => 'Dental Crown',
                'treatment_details' => 'Porcelain crown on upper front tooth',
                'treatment_date' => '2024-01-16',
                'cost' => 1200.00,
                'payment_status' => 'pending',
                'notes' => 'Temporary crown placed, permanent crown in 2 weeks'
            ],
        ];

        foreach ($treatments as $treatment) {
            TreatmentRecord::create($treatment);
        }
    }
} 