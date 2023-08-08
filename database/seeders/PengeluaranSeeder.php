<?php

namespace Database\Seeders;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $randomPemasukan = Pemasukan::where('status', 'disetujui')->inRandomOrder()->first();

            Pengeluaran::create([
                'nomor_pengeluaran' => 'PNG_' . $i,
                'sumber_dana' => $randomPemasukan->id,
                'nama_kegiatan' => 'Kegiatan ' . $i,
                'penanggung_jawab' => 'Muhammad Haykal',
                'lama_kegiatan' => $i,
                'tanggal_pengeluaran' => Carbon::now(),
                'jumlah_pengeluaran' => 20000000,
                'status' => fake()->randomElement(['disetujui', 'ditolak', 'menunggu'])
            ]);
        }
    }
}
