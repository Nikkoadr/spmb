<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Konsentrasi_keahlian;
use Illuminate\Support\Facades\DB;

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

        // Mengambil data per jurusan (total & daftar ulang) dengan satu query
        $jurusan = Konsentrasi_keahlian::select('id', 'nama_konsentrasi_keahlian')
            ->withCount([
                'pendaftaran as total_pendaftar',
                'pendaftaran as total_daftar_ulang' => function ($query) {
                    $query->whereIn('id_status_siswa', [3, 4]);
                }
            ])->get();

        // Rekap detail per asal sekolah
        $pendaftaran = DB::table('pendaftaran')
            ->join('asal_sekolah', 'pendaftaran.id_asal_sekolah', '=', 'asal_sekolah.id')
            ->select(
                'asal_sekolah.nama_asal_sekolah',
                DB::raw('COUNT(CASE WHEN pendaftaran.id_status_siswa = 1 THEN 1 END) as belum_ukur_belum_du'),
                DB::raw('COUNT(CASE WHEN pendaftaran.id_status_siswa = 2 THEN 1 END) as sudah_ukur_belum_du'),
                DB::raw('COUNT(CASE WHEN pendaftaran.id_status_siswa = 3 THEN 1 END) as sudah_du_belum_ukur'),
                DB::raw('COUNT(CASE WHEN pendaftaran.id_status_siswa = 4 THEN 1 END) as sudah_du_sudah_ukur'),
                DB::raw('COUNT(*) as total_pendaftaran_by_sekolah')
            )
            ->groupBy('asal_sekolah.nama_asal_sekolah')
            ->orderBy('total_pendaftaran_by_sekolah', 'desc')
            ->get();

        return view('dashboard', compact(
            'jumlah_pendaftaran',
            'jumlah_daftar_ulang',
            'jurusan',
            'pendaftaran'
        ));
    }
}
