<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asal_sekolah;
use App\Models\Pendaftaran;
use App\Models\Periode;

class PendaftaranController extends Controller
{
    public function form_pendaftaran()
    {
        $periode = DB::table('periode')->orderBy('created_at', 'desc')->first();
        $jenis_kelamin = DB::table('jenis_kelamin')->get();
        $asal_sekolah = DB::table('asal_sekolah')->get();
        $status_orang_tua = DB::table('status_orang_tua')->get();
        $konsentrasi_keahlian = DB::table('konsentrasi_keahlian')->get();

        return view('pendaftaran.form_pendaftaran', compact('jenis_kelamin', 'asal_sekolah', 'status_orang_tua', 'konsentrasi_keahlian', 'periode'));
    }

    public function getAsalSekolah(Request $request)
    {
        $search = $request->query('query');
        $sekolah = Asal_sekolah::where('nama_asal_sekolah', 'like', '%' . $search . '%')->get();

        return response()->json($sekolah);
    }

    public function proses_pendaftaran(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'nullable|string|max:20',
            'no_kk' => 'nullable|string|max:20',
            'no_nik' => 'nullable|string|max:20',
            'nama' => 'required|string|max:100',
            'id_jenis_kelamin' => 'required|integer|exists:jenis_kelamin,id',
            'id_asal_sekolah' => 'nullable|integer|exists:asal_sekolah,id',
            'id_status_orang_tua' => 'required|integer|exists:status_orang_tua,id',
            'id_konsentrasi_keahlian' => 'required|integer|exists:konsentrasi_keahlian,id',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date|before:today',
            'nama_asal_sekolah' => 'nullable|string|max:100',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'no_siswa' => 'required|string|max:20',
            'no_wali_siswa' => 'nullable|string|max:20',
            'blok' => 'nullable|string|max:100',
            'rt' => 'nullable|numeric',
            'rw' => 'nullable|numeric',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'referensi' => 'nullable|string|max:255',
        ]);

        $namaAsalSekolah = $validated['nama_asal_sekolah'] ?? null;
        unset($validated['nama_asal_sekolah']);

        if (empty($validated['id_asal_sekolah']) && $namaAsalSekolah) {

            // CARI SEKOLAH DENGAN NAMA YANG PERSIS SAMA
            $asal = Asal_sekolah::where('nama_asal_sekolah', $namaAsalSekolah)->first();

            // JIKA ADA → GUNAKAN ID LAMA
            if ($asal) {
                $validated['id_asal_sekolah'] = $asal->id;
            } else {
                // JIKA BELUM ADA → BUAT BARU
                $asal = Asal_sekolah::create([
                    'nama_asal_sekolah' => $namaAsalSekolah,
                ]);
                $validated['id_asal_sekolah'] = $asal->id;
            }
        }

        $periode = Periode::latest()->first();
        if (!$periode) {
            return back()->with('error', 'Periode belum tersedia, hubungi admin.');
        }

        $sudahAda = Pendaftaran::where('nama', $validated['nama'])
            ->where('tanggal_lahir', $validated['tanggal_lahir'])
            ->where('id_asal_sekolah', $validated['id_asal_sekolah'])
            ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->with('error', 'Calon siswa ini sudah terdaftar dalam sistem kami, silahkan lakukan daftar ulang ke sekolah.');
        }

        do {
            $noPendaftaran = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (Pendaftaran::where('no_pendaftaran', $noPendaftaran)->exists());

        $validated['no_pendaftaran'] = $noPendaftaran;
        $validated['id_periode'] = $periode->id;
        $validated['id_status_siswa'] = 1;

        $pendaftaran = Pendaftaran::create($validated);

        return redirect()
            ->route('bukti_pendaftaran', $pendaftaran->id)
            ->with('success', 'Pendaftaran berhasil disimpan!');
    }

    public function bukti_pendaftaran($id)
    {
        $pendaftaran = Pendaftaran::with([
            'periode',
            'jenis_kelamin',
            'asal_sekolah',
            'status_orang_tua',
            'konsentrasi_keahlian'
        ])->findOrFail($id);

        return view('pendaftaran.bukti_pendaftaran', compact('pendaftaran'));
    }
}
