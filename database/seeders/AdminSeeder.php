<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin TangCare',
            'email' => 'admin@tangcare.com',
            'password' => Hash::make('password'),
            'phone' => '021-55555555',
            'address' => 'Kantor TangCare, Tangerang, Banten',
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);
    }
}
