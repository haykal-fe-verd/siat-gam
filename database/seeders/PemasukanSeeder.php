<?php

namespace Database\Seeders;

use App\Models\Pemasukan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            Pemasukan::create([
                'nomor_pemasukan' => 'PMS_' . $i,
                'sumber_pemasukan' => 'OTSUS 2023',
                'tanggal_pemasukan' => Carbon::now()->format('Y-m-d'),
                'jumlah_pemasukan' => 20000000,
                'status' => fake()->randomElement(['disetujui', 'ditolak', 'menunggu'])
            ]);
        }
    }
}
