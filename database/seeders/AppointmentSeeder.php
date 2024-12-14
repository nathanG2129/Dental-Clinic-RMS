<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $appointments = [
            [
                'patient_id' => 1,
                'dentist_id' => 1,
                'appointment_date' => '2024-01-20 09:00:00',
                'purpose_of_appointment' => 'Regular Checkup',
                'status' => 'scheduled',
                'notes' => 'First time patient'
            ],
            [
                'patient_id' => 2,
                'dentist_id' => 1,
                'appointment_date' => '2024-01-20 10:00:00',
                'purpose_of_appointment' => 'Tooth Cleaning',
                'status' => 'scheduled',
                'notes' => null
            ],
            [
                'patient_id' => 3,
                'dentist_id' => 2,
                'appointment_date' => '2024-01-21 14:00:00',
                'purpose_of_appointment' => 'Cavity Filling',
                'status' => 'scheduled',
                'notes' => 'Patient requested afternoon appointment'
            ],
            [
                'patient_id' => 4,
                'dentist_id' => 2,
                'appointment_date' => '2024-01-19 11:00:00',
                'purpose_of_appointment' => 'Root Canal',
                'status' => 'completed',
                'notes' => 'Follow-up needed in 2 weeks'
            ],
            [
                'patient_id' => 5,
                'dentist_id' => 3,
                'appointment_date' => '2024-01-22 15:00:00',
                'purpose_of_appointment' => 'Orthodontic Consultation',
                'status' => 'scheduled',
                'notes' => null
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
} 