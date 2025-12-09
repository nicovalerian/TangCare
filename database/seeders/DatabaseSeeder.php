<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            YayasanSeeder::class,
            EventSeeder::class,
            DonationSeeder::class,
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('');
        $this->command->info('Default accounts created:');
        $this->command->info('  Admin: admin@tangcare.com / password');
        $this->command->info('  Yayasan 1: yayasan1@tangcare.com / password');
        $this->command->info('  Yayasan 2: yayasan2@tangcare.com / password');
        $this->command->info('  Yayasan 3: yayasan3@tangcare.com / password');
        $this->command->info('  Donors: donor1@example.com - donor5@example.com / password');
    }
}
