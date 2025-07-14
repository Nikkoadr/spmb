<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Cari_pendaftaranController extends Controller
{

    public function index()
    {
        return view('pendaftaran.form_cari_pendaftaran');
    }

    public function proses_cari_pendaftaran(Request $request)
    {
        $nama = $request->input('nama');
        $tanggal_lahir = $request->input('tanggal_lahir');

        $pendaftaran = DB::table('pendaftaran')
            ->leftJoin('asal_sekolah', 'pendaftaran.id_asal_sekolah', '=', 'asal_sekolah.id')
            ->select('pendaftaran.nama', 'pendaftaran.created_at', 'asal_sekolah.nama_asal_sekolah')
            ->where('pendaftaran.nama', 'LIKE', "%{$nama}%")
            ->where('pendaftaran.tanggal_lahir', $tanggal_lahir)
            ->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Maaf, Nama dan tanggal lahir Anda tidak terdaftar. Silakan daftarkan diri Anda.');
        } else {
            $tanggal = Carbon::parse($pendaftaran->created_at)->format('d-m-Y');
            $message = "Nama {$pendaftaran->nama}, asal sekolah {$pendaftaran->nama_asal_sekolah}, sudah terdaftar di sistem kami pada tanggal $tanggal. terima kasih";
            return redirect()->back()->with('success', $message);
        }
    }

    public function scan($code)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->leftJoin('asal_sekolah', 'pendaftaran.id_asal_sekolah', '=', 'asal_sekolah.id')
            ->leftJoin('konsentrasi_keahlian', 'pendaftaran.id_konsentrasi_keahlian', '=', 'konsentrasi_keahlian.id')
            ->leftJoin('status_orang_tua', 'pendaftaran.id_status_orang_tua', '=', 'status_orang_tua.id')
            ->leftJoin('jenis_kelamin', 'pendaftaran.id_jenis_kelamin', '=', 'jenis_kelamin.id')
            ->select(
                'pendaftaran.*',
                'asal_sekolah.nama_asal_sekolah',
                'konsentrasi_keahlian.nama_konsentrasi_keahlian',
                'status_orang_tua.nama_status_orang_tua',
                'jenis_kelamin.nama_jenis_kelamin'
            )->where('no_pendaftaran', $code)
            ->first();
        return view('pendaftaran.scan_pendaftaran', compact('pendaftaran'));
    }

    public function isi_ukuran_seragam($code)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->leftJoin('asal_sekolah', 'pendaftaran.id_asal_sekolah', '=', 'asal_sekolah.id')
            ->leftJoin('konsentrasi_keahlian', 'pendaftaran.id_konsentrasi_keahlian', '=', 'konsentrasi_keahlian.id')
            ->select(
                'pendaftaran.*',
                'asal_sekolah.nama_asal_sekolah',
                'konsentrasi_keahlian.nama_konsentrasi_keahlian'
            )
            ->where('no_pendaftaran', $code)
            ->first();
        return view('pendaftaran.form_isi_ukuran_seragam', compact('pendaftaran'));
    }

    public function proses_isi_ukuran_seragam(Request $request, $id)
    {

        $request->validate([
            'ukuran_baju' => 'required',
            // 'ukuran_celana' => 'required',
            'ukuran_panjang_celana' => 'required',
            'ukuran_lingkar_pinggang_celana' => 'required',
            'ukuran_sepatu' => 'required',
        ]);
        $cek_id_pendaftaran = DB::table('ukuran_seragam_siswa_baru')->where('id_pendaftaran', $id)->first();
        if ($cek_id_pendaftaran) {
            DB::table('ukuran_seragam_siswa_baru')->where('id_pendaftaran', $id)->update([
                'id_pendaftaran' => $id,
                'ukuran_baju' => $request->ukuran_baju,
                // 'ukuran_celana' => $request->ukuran_celana,
                'ukuran_panjang_celana' => $request->ukuran_panjang_celana,
                'ukuran_lingkar_pinggang_celana' => $request->ukuran_lingkar_pinggang_celana,
                'ukuran_sepatu' => $request->ukuran_sepatu,
            ]);
            if (Auth::check()) {
                return redirect('/data_ukuran_seragam')->with('success', 'Data ukuran baju, celana, dan sepatu berhasil diupdate.');
            } else {
                return redirect('/cari_pendaftaran')->with('success', 'Data ukuran baju, celana, dan sepatu berhasil diupdate.');
            }
        } else {
            DB::table('ukuran_seragam_siswa_baru')->insert([
                'id_pendaftaran' => $id,
                'ukuran_baju' => $request->ukuran_baju,
                // 'ukuran_celana' => $request->ukuran_celana,
                'ukuran_panjang_celana' => $request->ukuran_panjang_celana,
                'ukuran_lingkar_pinggang_celana' => $request->ukuran_lingkar_pinggang_celana,
                'ukuran_sepatu' => $request->ukuran_sepatu,
            ]);
            if (Auth::check()) {
                return redirect('/data_ukuran_seragam')->with('success', 'Data ukuran baju, celana, dan sepatu berhasil ditambahkan.');
            } else {
                return redirect('/cari_pendaftaran')->with('success', 'Data ukuran baju, celana, dan sepatu berhasil ditambahkan.');
            }
        }
    }
}
