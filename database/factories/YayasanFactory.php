<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Yayasan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Yayasan>
 */
class YayasanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Tangerang area coordinates (approximately -6.17 to -6.25 lat, 106.55 to 106.75 long)
        $tangerangLat = fake()->randomFloat(8, -6.25, -6.17);
        $tangerangLong = fake()->randomFloat(8, 106.55, 106.75);

        $yayasanPrefixes = ['Yayasan', 'Panti Asuhan', 'Rumah Singgah', 'Pondok Pesantren'];
        $yayasanNames = ['Kasih Ibu', 'Harapan Bangsa', 'Cahaya Hati', 'Bina Mandiri', 'Nurul Iman', 'Al-Falah', 'Sejahtera', 'Berkah Mulia'];
        
        $prefix = fake()->randomElement($yayasanPrefixes);
        $name = fake()->randomElement($yayasanNames);

        return [
            'user_id' => User::factory()->yayasan(),
            'name' => $prefix . ' ' . $name,
            'description' => fake('id_ID')->paragraphs(2, true),
            'address' => fake('id_ID')->streetAddress() . ', Tangerang, Banten',
            'latitude' => $tangerangLat,
            'longitude' => $tangerangLong,
            'verified_at' => fake()->optional(0.8)->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Indicate that the yayasan is verified.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'verified_at' => now(),
        ]);
    }

    /**
     * Indicate that the yayasan is unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'verified_at' => null,
        ]);
    }
}
