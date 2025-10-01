<?php

namespace App\Http\Controllers;

use App\Models\Ukuran_seragam_siswa_baru;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;

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

        $pendaftaran = Pendaftaran::with('asal_sekolah')
            ->where('nama', 'LIKE', "%{$nama}%")
            ->where('tanggal_lahir', $tanggal_lahir)
            ->first();

        if (!$pendaftaran) {
            return redirect()->back()
                ->with('error', 'Maaf, Nama dan tanggal lahir Anda tidak terdaftar. Silakan daftarkan diri Anda.');
        }

        $tanggal = Carbon::parse($pendaftaran->created_at)->format('d-m-Y');
        $message = "Nama {$pendaftaran->nama}, asal sekolah {$pendaftaran->asal_sekolah->nama_asal_sekolah}, sudah terdaftar di sistem kami pada tanggal $tanggal. Terima kasih";

        return redirect()->back()->with('success', $message);
    }

    public function scan($code)
    {
        $pendaftaran = Pendaftaran::with([
            'asal_sekolah:id,nama_asal_sekolah',
            'konsentrasi_keahlian:id,nama_konsentrasi_keahlian',
            'status_orang_tua:id,nama_status_orang_tua',
            'jenis_kelamin:id,nama_jenis_kelamin'
        ])
            ->where('no_pendaftaran', $code)
            ->first();

        return view('pendaftaran.scan_pendaftaran', compact('pendaftaran'));
    }

    public function isi_ukuran_seragam($code)
    {
        $pendaftaran = Pendaftaran::with([
            'asal_sekolah:id,nama_asal_sekolah',
            'konsentrasi_keahlian:id,nama_konsentrasi_keahlian'
        ])
            ->where('no_pendaftaran', $code)
            ->first();

        return view('pendaftaran.form_isi_ukuran_seragam', compact('pendaftaran'));
    }

    public function proses_isi_ukuran_seragam(Request $request, $id)
    {
        $request->validate([
            'ukuran_baju' => 'required',
            'ukuran_panjang_celana' => 'required',
            'ukuran_lingkar_pinggang_celana' => 'required',
            'ukuran_sepatu' => 'required',
        ]);

        // cek apakah sudah ada ukuran untuk id_pendaftaran ini
        $ukuran = Ukuran_seragam_siswa_baru::where('id_pendaftaran', $id)->first();

        if ($ukuran) {
            $ukuran->update([
                'ukuran_baju' => $request->ukuran_baju,
                'ukuran_panjang_celana' => $request->ukuran_panjang_celana,
                'ukuran_lingkar_pinggang_celana' => $request->ukuran_lingkar_pinggang_celana,
                'ukuran_sepatu' => $request->ukuran_sepatu,
            ]);

            $msg = 'Data ukuran baju, celana, dan sepatu berhasil diupdate.';
        } else {
            Ukuran_seragam_siswa_baru::create([
                'id_pendaftaran' => $id,
                'ukuran_baju' => $request->ukuran_baju,
                'ukuran_panjang_celana' => $request->ukuran_panjang_celana,
                'ukuran_lingkar_pinggang_celana' => $request->ukuran_lingkar_pinggang_celana,
                'ukuran_sepatu' => $request->ukuran_sepatu,
            ]);

            $msg = 'Data ukuran baju, celana, dan sepatu berhasil ditambahkan.';
        }

        return Auth::check()
            ? redirect('/data_ukuran_seragam')->with('success', $msg)
            : redirect('/cari_pendaftaran')->with('success', $msg);
    }
}
