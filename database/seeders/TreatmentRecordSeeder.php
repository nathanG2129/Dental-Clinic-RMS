<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TreatmentRecord;
use App\Models\Patient;
use App\Models\Dentist;
use Carbon\Carbon;

class TreatmentRecordSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        
        // Define common treatments with their typical costs
        $treatments = [
            'Regular Cleaning' => [
                'cost' => 150.00,
                'details' => 'Professional dental cleaning and polishing'
            ],
            'Deep Cleaning' => [
                'cost' => 300.00,
                'details' => 'Deep cleaning and scaling below the gum line'
            ],
            'Cavity Filling' => [
                'cost' => 250.00,
                'details' => 'Composite filling for dental cavity'
            ],
            'Root Canal' => [
                'cost' => 800.00,
                'details' => 'Root canal treatment including temporary filling'
            ],
            'Tooth Extraction' => [
                'cost' => 200.00,
                'details' => 'Simple tooth extraction procedure'
            ],
            'Dental Crown' => [
                'cost' => 1200.00,
                'details' => 'Porcelain crown installation'
            ],
            'Teeth Whitening' => [
                'cost' => 350.00,
                'details' => 'Professional teeth whitening treatment'
            ],
            'X-Ray' => [
                'cost' => 100.00,
                'details' => 'Digital dental X-ray imaging'
            ],
        ];

        // Create 50 treatment records over the past 6 months
        for ($i = 0; $i < 50; $i++) {
            $treatmentType = array_rand($treatments);
            $treatment = $treatments[$treatmentType];
            
            // Random date within the past 6 months
            $date = Carbon::now()->subMonths(6)->addDays(rand(0, 180));
            
            // Adjust cost slightly for variation
            $costVariation = rand(-20, 20);
            $finalCost = $treatment['cost'] + $costVariation;
            
            // Determine payment status based on date
            $paymentStatus = 'paid';
            if ($date->isAfter(Carbon::now()->subWeeks(2))) {
                $paymentStatus = ['pending', 'partially_paid', 'paid'][rand(0, 2)];
            }

            TreatmentRecord::create([
                'patient_id' => $patients->random()->patient_id,
                'dentist_id' => $dentists->random()->dentist_id,
                'treatment_type' => $treatmentType,
                'treatment_details' => $treatment['details'],
                'treatment_date' => $date,
                'cost' => $finalCost,
                'payment_status' => $paymentStatus,
                'notes' => $paymentStatus === 'partially_paid' ? 'Remaining balance to be paid' : null,
            ]);
        }
    }
} 