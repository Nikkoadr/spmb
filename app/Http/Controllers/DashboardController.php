<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Konsentrasi_keahlian;
use App\Models\Asal_sekolah;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Jumlah total pendaftaran
        $jumlah_pendaftaran = Pendaftaran::count();

        // Jumlah daftar ulang (status 3 dan 4)
        $jumlah_daftar_ulang = Pendaftaran::whereIn('id_status_siswa', [3, 4])->count();

        // Data per jurusan (total & daftar ulang)
        $jurusan = Konsentrasi_keahlian::select('id', 'nama_konsentrasi_keahlian')
            ->withCount([
                'pendaftaran as total_pendaftar',
                'pendaftaran as total_daftar_ulang' => function ($query) {
                    $query->whereIn('id_status_siswa', [3, 4]);
                }
            ])
            ->get();

        // Rekap detail per asal sekolah
        $pendaftaran = Asal_sekolah::select('id', 'nama_asal_sekolah')
            ->withCount([
                'pendaftaran as belum_ukur_belum_du' => function ($q) {
                    $q->where('id_status_siswa', 1);
                },
                'pendaftaran as sudah_ukur_belum_du' => function ($q) {
                    $q->where('id_status_siswa', 2);
                },
                'pendaftaran as sudah_du_belum_ukur' => function ($q) {
                    $q->where('id_status_siswa', 3);
                },
                'pendaftaran as sudah_du_sudah_ukur' => function ($q) {
                    $q->where('id_status_siswa', 4);
                },
                'pendaftaran as total_pendaftaran_by_sekolah'
            ])
            ->orderByDesc('total_pendaftaran_by_sekolah')
            ->get();

        return view('dashboard', compact(
            'jumlah_pendaftaran',
            'jumlah_daftar_ulang',
            'jurusan',
            'pendaftaran'
        ));
    }
}
