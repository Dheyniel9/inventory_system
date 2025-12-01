<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Restaurant Manager',
                'password' => Hash::make('password'),
                'phone' => '+1555-100-0001',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Admin');

        // Manager user
        $manager = User::firstOrCreate(
            ['email' => 'manager@buffet.com'],
            [
                'name' => 'Kitchen Manager',
                'password' => Hash::make('password'),
                'phone' => '+1555-100-0002',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $manager->assignRole('Manager');

        // Staff user
        $staff = User::firstOrCreate(
            ['email' => 'staff@buffet.com'],
            [
                'name' => 'Server Staff',
                'password' => Hash::make('password'),
                'phone' => '+1555-100-0003',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $staff->assignRole('Staff');

        // PWD Customer - Person with Disability (Special pricing/access)
        $pwdCustomer = User::firstOrCreate(
            ['email' => 'pwd.customer@buffet.com'],
            [
                'name' => 'Sarah Martinez (PWD)',
                'password' => Hash::make('password'),
                'phone' => '+1555-200-0001',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $pwdCustomer->assignRole('Staff'); // Give limited access for now

        // Regular Customer
        $regularCustomer = User::firstOrCreate(
            ['email' => 'regular.customer@buffet.com'],
            [
                'name' => 'John Thompson',
                'password' => Hash::make('password'),
                'phone' => '+1555-300-0001',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $regularCustomer->assignRole('Staff'); // Give limited access for now

        // Senior Customer
        $seniorCustomer = User::firstOrCreate(
            ['email' => 'senior.customer@buffet.com'],
            [
                'name' => 'Robert Wilson (Senior)',
                'password' => Hash::make('password'),
                'phone' => '+1555-400-0001',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $seniorCustomer->assignRole('Staff'); // Give limited access for now

        // Child Customer
        $childCustomer = User::firstOrCreate(
            ['email' => 'child.customer@buffet.com'],
            [
                'name' => 'Emma Davis (Child)',
                'password' => Hash::make('password'),
                'phone' => '+1555-500-0001',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $childCustomer->assignRole('Staff'); // Give limited access for now
    }
}
