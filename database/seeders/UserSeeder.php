<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@dentalclinic.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create 5 dentist users
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Dr. Dentist {$i}",
                'email' => "dentist{$i}@dentalclinic.com",
                'password' => Hash::make('password123'),
                'role' => 'dentist',
            ]);
        }

        // Create 3 employee users
        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "Employee {$i}",
                'email' => "employee{$i}@dentalclinic.com",
                'password' => Hash::make('password123'),
                'role' => 'employee',
            ]);
        }
    }
} 