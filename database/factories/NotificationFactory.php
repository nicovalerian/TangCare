<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $notifications = [
            [
                'title' => 'Donasi Diterima',
                'body' => 'Donasi Anda telah diterima oleh Yayasan. Silakan kirim barang sesuai metode yang dipilih.',
            ],
            [
                'title' => 'Donasi Ditolak',
                'body' => 'Maaf, donasi Anda tidak dapat diterima saat ini. Silakan cek alasan penolakan.',
            ],
            [
                'title' => 'Barang Telah Diterima',
                'body' => 'Terima kasih! Barang donasi Anda telah sampai dan diterima dengan baik.',
            ],
            [
                'title' => 'Event Baru di Sekitar Anda',
                'body' => 'Ada event donasi baru di wilayah Tangerang. Yuk, ikut berpartisipasi!',
            ],
            [
                'title' => 'Pencapaian Donasi',
                'body' => 'Selamat! Anda telah berkontribusi lebih dari 10kg donasi. Terima kasih atas kebaikan Anda.',
            ],
        ];

        $notification = fake()->randomElement($notifications);

        return [
            'user_id' => User::factory(),
            'title' => $notification['title'],
            'body' => $notification['body'],
            'is_read' => fake()->boolean(30), // 30% chance of being read
        ];
    }

    /**
     * Indicate that the notification is unread.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => false,
        ]);
    }

    /**
     * Indicate that the notification is read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_read' => true,
        ]);
    }
}
