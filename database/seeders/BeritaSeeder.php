<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            Berita::create([
                'judul' => 'Judul Ke-' . $i,
                'isi' => '<p style="text-align: justify; "><b>Lorem ipsum</b> dolor sit amet consectetur, adipisicing elit. Eos, quae non quo <u><strike><i><b>facilis earum et accusamus&nbsp; </b></i></strike></u>ut provident totam illo saepe necessitatibus commodi aperiam minima tempora quaerat ullam fuga sed est repudiandae! Pariatur repudiandae ut nesciunt assumenda amet, dolores dolore excepturi quod accusantium harum omnis quasi in rerum ullam deleniti rem, iste, reprehenderit nobis maxime magnam fugiat aspernatur! Quibusdam, itaque nisi, iste architecto officiis quam pariatur cum aliquid repellat, repudiandae qui molestiae? Et ullam commodi amet quod inventore. Voluptatem est ad ut iure error natus, cupiditate asperiores repellendus et officia, iste earum quos magnam omnis, id dolor praesentium ab atque?<br></p>',
                'thumbnail' => 'public/thumbnails/QwzdUGfqP8tfOZYdVw7x6aGFrB6PWtuqvEuyVkMX.png',
            ]);
        }
    }
}
