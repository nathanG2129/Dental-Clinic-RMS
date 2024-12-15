<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Dentist;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $dentists = Dentist::all();
        
        // Common dental appointment purposes
        $purposes = [
            'Regular Checkup',
            'Teeth Cleaning',
            'Cavity Filling',
            'Root Canal',
            'Tooth Extraction',
            'Dental Crown',
            'Braces Adjustment',
            'Wisdom Tooth Consultation',
            'Gum Treatment',
            'Dental X-Ray'
        ];

        // Create appointments for the next 30 days
        for ($day = 0; $day < 30; $day++) {
            $date = Carbon::now()->addDays($day);
            
            // Skip weekends
            if ($date->isWeekend()) {
                continue;
            }

            // Create 3-5 appointments per day
            $appointmentsPerDay = rand(3, 5);
            
            for ($i = 0; $i < $appointmentsPerDay; $i++) {
                // Generate appointment time between 9 AM and 4 PM
                $hour = rand(9, 16);
                $minute = [0, 30][rand(0, 1)]; // Only allow appointments at :00 or :30
                
                $appointmentDateTime = $date->copy()->setHour($hour)->setMinute($minute);
                
                // Random status weighted towards 'scheduled' for future dates
                $status = 'scheduled';
                if ($date->isPast()) {
                    $status = ['completed', 'cancelled'][rand(0, 1)];
                }

                Appointment::create([
                    'patient_id' => $patients->random()->patient_id,
                    'dentist_id' => $dentists->random()->dentist_id,
                    'appointment_date' => $appointmentDateTime,
                    'purpose_of_appointment' => $purposes[array_rand($purposes)],
                    'status' => $status,
                    'notes' => $status === 'cancelled' ? 'Cancelled by patient' : null,
                ]);
            }
        }
    }
} 