<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Yayasan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventTitles = [
            'Donasi Pakaian Layak Pakai',
            'Bantuan Banjir',
            'Donasi Buku Sekolah',
            'Bantuan Sembako',
            'Donasi Mainan Anak',
            'Penggalangan Alat Tulis',
            'Donasi Peralatan Rumah Tangga',
            'Bantuan Korban Bencana',
        ];

        $title = fake()->randomElement($eventTitles);
        $isOngoing = fake()->boolean(40); // 40% chance of being ongoing

        return [
            'yayasan_id' => Yayasan::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(4),
            'description' => fake('id_ID')->paragraphs(3, true),
            'banner_image' => null,
            'start_date' => $isOngoing ? null : fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => $isOngoing ? null : fake()->dateTimeBetween('+1 month', '+3 months'),
            'is_active' => fake()->boolean(85), // 85% chance of being active
        ];
    }

    /**
     * Indicate that the event is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the event is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the event is ongoing (no end date).
     */
    public function ongoing(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => null,
            'end_date' => null,
            'is_active' => true,
        ]);
    }

    /**
     * Indicate that the event is time-limited.
     */
    public function timeLimited(): static
    {
        return $this->state(fn (array $attributes) => [
            'start_date' => fake()->dateTimeBetween('-1 week', 'now'),
            'end_date' => fake()->dateTimeBetween('+1 week', '+2 months'),
            'is_active' => true,
        ]);
    }
}
