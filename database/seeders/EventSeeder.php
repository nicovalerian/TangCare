<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Yayasan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yayasans = Yayasan::all();

        $events = [
            // Events for Yayasan Kasih Ibu
            [
                'yayasan_index' => 0,
                'title' => 'Donasi Pakaian Layak Pakai',
                'description' => 'Kami menerima donasi pakaian bekas layak pakai untuk anak-anak usia 5-15 tahun. Pakaian harus dalam kondisi bersih dan tidak rusak. Semua donasi akan didistribusikan langsung kepada anak-anak asuh kami.',
                'start_date' => null,
                'end_date' => null,
                'is_active' => true,
            ],
            [
                'yayasan_index' => 0,
                'title' => 'Bantuan Banjir Ciledug Desember 2024',
                'description' => 'Penggalangan bantuan untuk korban banjir di wilayah Ciledug. Kami membutuhkan selimut, pakaian, makanan siap saji, dan air mineral. Bantuan akan segera disalurkan ke posko-posko pengungsian.',
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-31',
                'is_active' => true,
            ],
            // Events for Panti Asuhan Harapan Bangsa
            [
                'yayasan_index' => 1,
                'title' => 'Donasi Buku Sekolah',
                'description' => 'Kami membutuhkan buku pelajaran untuk SD, SMP, dan SMA. Buku bekas maupun baru sangat kami hargai. Donasi buku akan membantu anak-anak kami dalam mengejar pendidikan yang lebih baik.',
                'start_date' => null,
                'end_date' => null,
                'is_active' => true,
            ],
            [
                'yayasan_index' => 1,
                'title' => 'Penggalangan Alat Tulis Tahun Ajaran Baru',
                'description' => 'Menyambut tahun ajaran baru 2025, kami menggalang donasi alat tulis seperti pensil, pulpen, buku tulis, penggaris, dan perlengkapan sekolah lainnya untuk anak-anak asuh kami.',
                'start_date' => '2024-12-15',
                'end_date' => '2025-01-15',
                'is_active' => true,
            ],
            // Events for Rumah Singgah Cahaya Hati
            [
                'yayasan_index' => 2,
                'title' => 'Bantuan Sembako Bulanan',
                'description' => 'Program donasi sembako rutin untuk membantu kebutuhan pangan keluarga dhuafa di sekitar Tangerang. Kami menerima beras, minyak goreng, gula, mie instan, dan kebutuhan pokok lainnya.',
                'start_date' => null,
                'end_date' => null,
                'is_active' => true,
            ],
            [
                'yayasan_index' => 2,
                'title' => 'Donasi Mainan Anak',
                'description' => 'Berbagi kebahagiaan dengan anak-anak melalui donasi mainan. Kami menerima mainan bekas layak pakai seperti boneka, puzzle, lego, dan mainan edukatif lainnya.',
                'start_date' => null,
                'end_date' => null,
                'is_active' => true,
            ],
        ];

        foreach ($events as $eventData) {
            if (isset($yayasans[$eventData['yayasan_index']])) {
                $yayasan = $yayasans[$eventData['yayasan_index']];
                
                Event::create([
                    'yayasan_id' => $yayasan->id,
                    'title' => $eventData['title'],
                    'slug' => Str::slug($eventData['title']),
                    'description' => $eventData['description'],
                    'start_date' => $eventData['start_date'],
                    'end_date' => $eventData['end_date'],
                    'is_active' => $eventData['is_active'],
                ]);
            }
        }
    }
}
