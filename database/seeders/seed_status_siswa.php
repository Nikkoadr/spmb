<?php

namespace Database\Seeders;

use App\Models\Status_siswa;
use Illuminate\Database\Seeder;

class seed_status_siswa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status_siswa::create([
            'nama_status_siswa' => 'Belum Ukur Seragam+Belum DU',
        ]);
        Status_siswa::create([
            'nama_status_siswa' => 'Sudah Ukur Seragam+Belum DU',
        ]);
        Status_siswa::create([
            'nama_status_siswa' => 'Sudah DU+Belum Ukur Seragam',
        ]);
        Status_siswa::create([
            'nama_status_siswa' => 'Sudah DU+Sudah Ukur Seragam',
        ]);
    }
}
