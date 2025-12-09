<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Event;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some donor users
        $donors = [];
        $donorData = [
            ['name' => 'Dewi Lestari', 'email' => 'donor1@example.com'],
            ['name' => 'Rizki Pratama', 'email' => 'donor2@example.com'],
            ['name' => 'Indah Permata', 'email' => 'donor3@example.com'],
            ['name' => 'Andi Wijaya', 'email' => 'donor4@example.com'],
            ['name' => 'Maya Sari', 'email' => 'donor5@example.com'],
        ];

        foreach ($donorData as $data) {
            $donors[] = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'phone' => '08' . rand(10, 99) . '-' . rand(1000, 9999) . '-' . rand(1000, 9999),
                'address' => 'Tangerang, Banten',
                'role' => User::ROLE_DONOR,
                'email_verified_at' => now(),
            ]);
        }

        $events = Event::all();

        $donations = [
            // Donations with different statuses
            [
                'donor_index' => 0,
                'event_index' => 0,
                'weight_kg' => 5.5,
                'description' => '10 potong baju anak ukuran S-M, kondisi bagus, sudah dicuci bersih',
                'delivery_method' => Donation::DELIVERY_SELF,
                'status' => Donation::STATUS_RECEIVED,
            ],
            [
                'donor_index' => 1,
                'event_index' => 0,
                'weight_kg' => 3.2,
                'description' => '5 pasang celana anak dan 3 kaos, masih layak pakai',
                'delivery_method' => Donation::DELIVERY_COURIER,
                'status' => Donation::STATUS_ACCEPTED,
            ],
            [
                'donor_index' => 2,
                'event_index' => 1,
                'weight_kg' => 10.0,
                'description' => '2 karung pakaian dewasa dan anak, selimut 3 buah',
                'delivery_method' => Donation::DELIVERY_EXPEDITION,
                'status' => Donation::STATUS_PENDING,
            ],
            [
                'donor_index' => 3,
                'event_index' => 2,
                'weight_kg' => 8.0,
                'description' => 'Buku pelajaran SD lengkap kelas 1-6, kondisi 80%',
                'delivery_method' => Donation::DELIVERY_SELF,
                'status' => Donation::STATUS_RECEIVED,
            ],
            [
                'donor_index' => 4,
                'event_index' => 2,
                'weight_kg' => 2.5,
                'description' => 'Buku cerita anak dan komik edukatif 20 buah',
                'delivery_method' => Donation::DELIVERY_COURIER,
                'status' => Donation::STATUS_RECEIVED,
            ],
            [
                'donor_index' => 0,
                'event_index' => 3,
                'weight_kg' => 1.5,
                'description' => 'Alat tulis lengkap: pensil, pulpen, penghapus, penggaris untuk 15 anak',
                'delivery_method' => Donation::DELIVERY_SELF,
                'status' => Donation::STATUS_ACCEPTED,
            ],
            [
                'donor_index' => 1,
                'event_index' => 4,
                'weight_kg' => 15.0,
                'description' => 'Beras 10kg, minyak goreng 2L, gula 2kg, mie instan 1 dus',
                'delivery_method' => Donation::DELIVERY_EXPEDITION,
                'status' => Donation::STATUS_RECEIVED,
            ],
            [
                'donor_index' => 2,
                'event_index' => 5,
                'weight_kg' => 4.0,
                'description' => 'Mainan puzzle, lego, dan boneka 10 buah',
                'delivery_method' => Donation::DELIVERY_SELF,
                'status' => Donation::STATUS_PENDING,
            ],
            [
                'donor_index' => 3,
                'event_index' => 0,
                'weight_kg' => 6.0,
                'description' => 'Pakaian anak remaja ukuran L-XL',
                'delivery_method' => Donation::DELIVERY_COURIER,
                'status' => Donation::STATUS_REJECTED,
                'rejection_reason' => 'Maaf, saat ini kami lebih membutuhkan pakaian untuk anak usia 5-12 tahun',
            ],
            [
                'donor_index' => 4,
                'event_index' => 4,
                'weight_kg' => 20.0,
                'description' => 'Sembako lengkap: beras 15kg, minyak 3L, telur 2 tray',
                'delivery_method' => Donation::DELIVERY_EXPEDITION,
                'status' => Donation::STATUS_RECEIVED,
            ],
        ];

        foreach ($donations as $donationData) {
            if (isset($donors[$donationData['donor_index']]) && isset($events[$donationData['event_index']])) {
                $donation = Donation::create([
                    'user_id' => $donors[$donationData['donor_index']]->id,
                    'event_id' => $events[$donationData['event_index']]->id,
                    'weight_kg' => $donationData['weight_kg'],
                    'description' => $donationData['description'],
                    'delivery_method' => $donationData['delivery_method'],
                    'status' => $donationData['status'],
                    'rejection_reason' => $donationData['rejection_reason'] ?? null,
                ]);

                // Create notification for the donor based on status
                $this->createNotificationForDonation($donation);
            }
        }
    }

    /**
     * Create notification based on donation status.
     */
    private function createNotificationForDonation(Donation $donation): void
    {
        $notification = match($donation->status) {
            Donation::STATUS_ACCEPTED => [
                'title' => 'Donasi Diterima',
                'body' => "Donasi Anda untuk event \"{$donation->event->title}\" telah diterima. Silakan kirim barang sesuai metode yang dipilih.",
            ],
            Donation::STATUS_REJECTED => [
                'title' => 'Donasi Ditolak',
                'body' => "Maaf, donasi Anda untuk event \"{$donation->event->title}\" tidak dapat diterima. Alasan: {$donation->rejection_reason}",
            ],
            Donation::STATUS_RECEIVED => [
                'title' => 'Barang Telah Diterima',
                'body' => "Terima kasih! Donasi Anda seberat {$donation->weight_kg}kg untuk event \"{$donation->event->title}\" telah kami terima dengan baik.",
            ],
            default => null,
        };

        if ($notification) {
            Notification::create([
                'user_id' => $donation->user_id,
                'title' => $notification['title'],
                'body' => $notification['body'],
                'is_read' => false,
            ]);
        }
    }
}
