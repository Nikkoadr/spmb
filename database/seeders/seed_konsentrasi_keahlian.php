<?php

namespace Database\Seeders;

use App\Models\Konsentrasi_keahlian;
use Illuminate\Database\Seeder;

class seed_konsentrasi_keahlian extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Konsentrasi_keahlian::create([
            'nama_konsentrasi_keahlian' => 'Teknik Pengelasan',
        ]);
        Konsentrasi_keahlian::create([
            'nama_konsentrasi_keahlian' => 'Teknik Elektronika Industri',
        ]);
        Konsentrasi_keahlian::create([
            'nama_konsentrasi_keahlian' => 'Teknik Kendaraan Ringan',
        ]);
        Konsentrasi_keahlian::create([
            'nama_konsentrasi_keahlian' => 'Teknik Komputer dan Jaringan',
        ]);
        Konsentrasi_keahlian::create([
            'nama_konsentrasi_keahlian' => 'Teknik Sepeda Motor',
        ]);
        Konsentrasi_keahlian::create([
            'nama_konsentrasi_keahlian' => 'Layanan Penunjang Kefarmasian Klinis dan Komunitas',
        ]);
    }
}
