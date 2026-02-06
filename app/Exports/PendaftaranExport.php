<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('pendaftaran')
            ->leftJoin('periode', 'pendaftaran.id_periode', '=', 'periode.id')
            ->leftJoin('status_siswa', 'pendaftaran.id_status_siswa', '=', 'status_siswa.id')
            ->leftJoin('asal_sekolah', 'pendaftaran.id_asal_sekolah', '=', 'asal_sekolah.id')
            ->leftJoin('jenis_kelamin', 'pendaftaran.id_jenis_kelamin', '=', 'jenis_kelamin.id')
            ->leftJoin('konsentrasi_keahlian', 'pendaftaran.id_konsentrasi_keahlian', '=', 'konsentrasi_keahlian.id')
            ->leftJoin('status_orang_tua', 'pendaftaran.id_status_orang_tua', '=', 'status_orang_tua.id')
            ->select(
                'status_siswa.nama_status_siswa',
                'pendaftaran.no_pendaftaran',
                'periode.tahun_ajaran',
                'periode.periode_aktif',
                'pendaftaran.nisn',
                'pendaftaran.no_kk',
                'pendaftaran.no_nik',
                'pendaftaran.nama',
                'jenis_kelamin.nama_jenis_kelamin',
                'pendaftaran.tempat_lahir',
                'pendaftaran.tanggal_lahir',
                'status_orang_tua.nama_status_orang_tua',
                'pendaftaran.nik_ayah',
                'pendaftaran.nama_ayah',
                'pendaftaran.pekerjaan_ayah',
                'pendaftaran.nik_ibu',
                'pendaftaran.nama_ibu',
                'pendaftaran.pekerjaan_ibu',
                'pendaftaran.blok',
                'pendaftaran.rt',
                'pendaftaran.rw',
                'pendaftaran.desa',
                'pendaftaran.kecamatan',
                'pendaftaran.kabupaten',
                'pendaftaran.no_siswa',
                'pendaftaran.no_wali_siswa',
                'asal_sekolah.nama_asal_sekolah',
                'konsentrasi_keahlian.nama_konsentrasi_keahlian',
                'pendaftaran.referensi',
            )
            ->get();
    }
    public function headings(): array
    {
        return [
            'Status Siswa',
            'No. Pendaftaran',
            'Tahun Ajaran',
            'Periode Aktif',
            'NISN',
            'No. KK',
            'No. NIK',
            'Nama',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status Orang Tua',
            'NIK Ayah',
            'Nama Ayah',
            'Pekerjaan Ayah',
            'NIK Ibu',
            'Nama Ibu',
            'Pekerjaan Ibu',
            'Blok',
            'RT',
            'RW',
            'Desa',
            'Kecamatan',
            'Kabupaten',
            'No. Siswa',
            'No. Wali Siswa',
            'Asal Sekolah',
            'Konsentrasi Keahlian',
            'Referensi',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nama_status_siswa ?? 'Belum Memiliki Status Siswa',
            $row->no_pendaftaran ?? 'Belum Memiliki No. Pendaftaran',
            $row->tahun_ajaran ?? 'Belum Memiliki Tahun Ajaran',
            $row->periode_aktif ?? 'Belum Memiliki Periode Aktif',

            $row->nisn ? "'" . $row->nisn : 'Belum Memiliki NISN',
            $row->no_kk ? "'" . $row->no_kk : 'Belum Memiliki No. KK',
            $row->no_nik ? "'" . $row->no_nik : 'Belum Memiliki NIK',

            $row->nama ?? 'Belum Memiliki Nama',
            $row->nama_jenis_kelamin ?? 'Belum Memiliki Jenis Kelamin',
            $row->tempat_lahir ?? 'Belum Memiliki Tempat Lahir',
            $row->tanggal_lahir ?? 'Belum Memiliki Tanggal Lahir',

            $row->nama_status_orang_tua ?? 'Belum Memiliki Status Orang Tua',

            $row->nik_ayah ? "'" . $row->nik_ayah : 'Belum Memiliki NIK Ayah',
            $row->nama_ayah ?? 'Belum Memiliki Nama Ayah',
            $row->pekerjaan_ayah ?? 'Belum Memiliki Pekerjaan Ayah',

            $row->nik_ibu ? "'" . $row->nik_ibu : 'Belum Memiliki NIK Ibu',
            $row->nama_ibu ?? 'Belum Memiliki Nama Ibu',
            $row->pekerjaan_ibu ?? 'Belum Memiliki Pekerjaan Ibu',

            $row->blok ?? 'Belum Memiliki Blok',
            $row->rt ?? 'Belum Memiliki RT',
            $row->rw ?? 'Belum Memiliki RW',
            $row->desa ?? 'Belum Memiliki Desa',
            $row->kecamatan ?? 'Belum Memiliki Kecamatan',
            $row->kabupaten ?? 'Belum Memiliki Kabupaten',

            $row->no_siswa ? "'" . $row->no_siswa : 'Belum Memiliki No. Siswa',
            $row->no_wali_siswa ? "'" . $row->no_wali_siswa : 'Belum Memiliki No. Wali Siswa',

            $row->nama_asal_sekolah ?? 'Belum Memiliki Asal Sekolah',
            $row->nama_konsentrasi_keahlian ?? 'Belum Memiliki Konsentrasi Keahlian',
            $row->referensi ?? 'Belum Memiliki Referensi',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
