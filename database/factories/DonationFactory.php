<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $itemDescriptions = [
            'Pakaian bekas layak pakai untuk dewasa, kondisi baik',
            'Buku pelajaran SD kelas 1-6, masih lengkap',
            'Mainan anak-anak, kondisi masih bagus',
            'Sepatu sekolah ukuran 35-40',
            'Alat tulis (pensil, pulpen, penghapus, penggaris)',
            'Tas sekolah bekas masih layak pakai',
            'Selimut dan sprei bekas kondisi bersih',
            'Peralatan makan (piring, sendok, garpu)',
            'Beras 5kg dan mie instan',
            'Susu formula dan makanan bayi',
        ];

        $status = fake()->randomElement([
            Donation::STATUS_PENDING,
            Donation::STATUS_ACCEPTED,
            Donation::STATUS_REJECTED,
            Donation::STATUS_RECEIVED,
        ]);

        return [
            'user_id' => User::factory()->donor(),
            'event_id' => Event::factory(),
            'weight_kg' => fake()->randomFloat(2, 0.5, 25),
            'description' => fake()->randomElement($itemDescriptions),
            'delivery_method' => fake()->randomElement([
                Donation::DELIVERY_SELF,
                Donation::DELIVERY_COURIER,
                Donation::DELIVERY_EXPEDITION,
            ]),
            'status' => $status,
            'rejection_reason' => $status === Donation::STATUS_REJECTED 
                ? fake()->randomElement([
                    'Maaf, barang tidak sesuai dengan kebutuhan kami saat ini',
                    'Gudang penuh, mohon tunggu pemberitahuan selanjutnya',
                    'Kondisi barang kurang layak untuk distribusi',
                ])
                : null,
            'image_path' => null,
        ];
    }

    /**
     * Indicate that the donation is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Donation::STATUS_PENDING,
            'rejection_reason' => null,
        ]);
    }

    /**
     * Indicate that the donation is accepted.
     */
    public function accepted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Donation::STATUS_ACCEPTED,
            'rejection_reason' => null,
        ]);
    }

    /**
     * Indicate that the donation is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Donation::STATUS_REJECTED,
            'rejection_reason' => 'Maaf, barang tidak sesuai dengan kebutuhan kami saat ini',
        ]);
    }

    /**
     * Indicate that the donation is received.
     */
    public function received(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Donation::STATUS_RECEIVED,
            'rejection_reason' => null,
        ]);
    }
}
