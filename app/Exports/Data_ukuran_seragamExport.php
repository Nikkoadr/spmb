<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Data_ukuran_seragamExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('ukuran_seragam_siswa_baru')
            ->leftJoin('pendaftaran', 'ukuran_seragam_siswa_baru.id_pendaftaran', '=', 'pendaftaran.id')
            ->leftJoin('konsentrasi_keahlian', 'pendaftaran.id_konsentrasi_keahlian', '=', 'konsentrasi_keahlian.id')
            ->leftJoin('jenis_kelamin', 'pendaftaran.id_jenis_kelamin', '=', 'jenis_kelamin.id')
            ->leftJoin('asal_sekolah', 'pendaftaran.id_asal_sekolah', '=', 'asal_sekolah.id')
            ->select(
                'ukuran_seragam_siswa_baru.*',
                'pendaftaran.nama',
                'pendaftaran.no_pendaftaran',
                'konsentrasi_keahlian.nama_konsentrasi_keahlian',
                'jenis_kelamin.nama_jenis_kelamin',
                'asal_sekolah.nama_asal_sekolah'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Nama',
            'Jenis Kelamin',
            'Asal Sekolah',
            'Konsentrasi Keahlian',
            'Ukuran Baju',
            'Ukuran Celana',
            'Ukuran Sepatu',
        ];
    }

    public function map($row): array
    {
        return [
            $row->no_pendaftaran,
            $row->nama,
            $row->nama_jenis_kelamin,
            $row->nama_asal_sekolah,
            $row->nama_konsentrasi_keahlian,
            $row->ukuran_baju,
            $row->ukuran_celana,
            $row->ukuran_sepatu,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
