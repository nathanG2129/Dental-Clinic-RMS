<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@dental.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create dentist users
        $dentists = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@dental.com',
                'role' => 'dentist',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@dental.com',
                'role' => 'dentist',
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@dental.com',
                'role' => 'dentist',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@dental.com',
                'role' => 'dentist',
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@dental.com',
                'role' => 'dentist',
            ],
        ];

        foreach ($dentists as $dentist) {
            User::create([
                'name' => $dentist['name'],
                'email' => $dentist['email'],
                'password' => Hash::make('password'),
                'role' => $dentist['role'],
            ]);
        }

        // Create employee users
        $employees = [
            [
                'name' => 'Jane Cooper',
                'email' => 'jane.cooper@dental.com',
            ],
            [
                'name' => 'Robert Fox',
                'email' => 'robert.fox@dental.com',
            ],
        ];

        foreach ($employees as $employee) {
            User::create([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'password' => Hash::make('password'),
                'role' => 'employee',
            ]);
        }
    }
} 