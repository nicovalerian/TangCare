<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Yayasan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class YayasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yayasans = [
            [
                'user' => [
                    'name' => 'Ahmad Hidayat',
                    'email' => 'yayasan1@tangcare.com',
                    'password' => Hash::make('password'),
                    'phone' => '0812-1234-5678',
                    'role' => User::ROLE_YAYASAN,
                    'email_verified_at' => now(),
                ],
                'yayasan' => [
                    'name' => 'Yayasan Kasih Ibu',
                    'description' => 'Yayasan Kasih Ibu adalah lembaga sosial yang berfokus pada pemberdayaan anak-anak yatim piatu dan dhuafa di wilayah Tangerang. Kami menyediakan pendidikan, tempat tinggal, dan dukungan emosional bagi anak-anak yang membutuhkan.',
                    'address' => 'Jl. Merdeka No. 45, Ciledug, Tangerang',
                    'latitude' => -6.2237,
                    'longitude' => 106.7088,
                    'verified_at' => now(),
                ],
            ],
            [
                'user' => [
                    'name' => 'Siti Nurhaliza',
                    'email' => 'yayasan2@tangcare.com',
                    'password' => Hash::make('password'),
                    'phone' => '0813-9876-5432',
                    'role' => User::ROLE_YAYASAN,
                    'email_verified_at' => now(),
                ],
                'yayasan' => [
                    'name' => 'Panti Asuhan Harapan Bangsa',
                    'description' => 'Panti Asuhan Harapan Bangsa telah berdiri sejak tahun 1995 dan telah mengasuh lebih dari 500 anak. Kami berkomitmen untuk memberikan kehidupan yang layak dan masa depan yang cerah bagi anak-anak Indonesia.',
                    'address' => 'Jl. Sudirman No. 123, Serpong, Tangerang Selatan',
                    'latitude' => -6.2546,
                    'longitude' => 106.6692,
                    'verified_at' => now(),
                ],
            ],
            [
                'user' => [
                    'name' => 'Budi Santoso',
                    'email' => 'yayasan3@tangcare.com',
                    'password' => Hash::make('password'),
                    'phone' => '0821-5555-1234',
                    'role' => User::ROLE_YAYASAN,
                    'email_verified_at' => now(),
                ],
                'yayasan' => [
                    'name' => 'Rumah Singgah Cahaya Hati',
                    'description' => 'Rumah Singgah Cahaya Hati adalah tempat perlindungan sementara bagi anak jalanan dan kaum dhuafa. Kami menyediakan makanan, pakaian, dan bimbingan untuk membantu mereka kembali ke masyarakat.',
                    'address' => 'Jl. Gatot Subroto No. 78, Cimone, Tangerang',
                    'latitude' => -6.1871,
                    'longitude' => 106.6233,
                    'verified_at' => now(),
                ],
            ],
        ];

        foreach ($yayasans as $data) {
            $user = User::create($data['user']);
            $user->yayasan()->create($data['yayasan']);
        }
    }
}
