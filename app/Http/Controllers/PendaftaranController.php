<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asal_sekolah;
use Illuminate\Support\Str;

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
        $cek_data = DB::table('pendaftaran')
            ->where('nama', $request->nama)
            ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if ($cek_data) {
            return redirect()->back()->with(['error' => 'Data dengan nama dan tanggal lahir yang sama sudah ada dalam database kami !']);
        }

        $request->validate([
            'tahun_ajaran' => 'required',
            'periode' => 'required',
            'nisn' => 'nullable',
            'no_kk' => 'nullable',
            'no_nik' => 'nullable',
            'nama' => 'required|string|max:100',
            'id_jenis_kelamin' => 'required|integer|exists:jenis_kelamin,id',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date|before:today',
            'id_asal_sekolah' => 'nullable|integer|exists:asal_sekolah,id',
            'nama_asal_sekolah' => 'required|string|max:100',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'id_status_orang_tua' => 'required|integer|exists:status_orang_tua,id',
            'no_siswa' => 'required|string|max:20',
            'no_wali_siswa' => 'nullable|string|max:20',
            'blok' => 'nullable|string|max:100',
            'rt' => 'nullable|numeric',
            'rw' => 'nullable|numeric',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'id_konsentrasi_keahlian' => 'required|integer|exists:konsentrasi_keahlian,id',
            'referensi' => 'nullable|string|max:255',
        ]);

        $id_asal_sekolah = $request->input('id_asal_sekolah');

        if (!$id_asal_sekolah) {
            $id_asal_sekolah = DB::table('asal_sekolah')->insertGetId([
                'nama_asal_sekolah' => $request->input('nama_asal_sekolah'),
                'created_at' => now(),
            ]);
        }

        $no_pendaftaran = 'SPMB-' . date('Y') . '-' . Str::upper(Str::random(4));
        $periode = DB::table('periode')->orderBy('created_at', 'desc')->first();

        $id_pendaftaran = DB::table('pendaftaran')->insertGetId([
            'id_periode' => $periode->id,
            'no_pendaftaran' => $no_pendaftaran,
            'id_status_siswa' => 1,
            'nisn' => $request->nisn,
            'no_kk' => $request->no_kk,
            'no_nik' => $request->no_nik,
            'nama' => $request->nama,
            'id_jenis_kelamin' => $request->id_jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_asal_sekolah' => $id_asal_sekolah,
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'id_status_orang_tua' => $request->id_status_orang_tua,
            'no_siswa' => $request->no_siswa,
            'no_wali_siswa' => $request->no_wali_siswa,
            'blok' => $request->blok,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'id_konsentrasi_keahlian' => $request->id_konsentrasi_keahlian,
            'referensi' => $request->referensi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect('/bukti_pendaftaran/' . $id_pendaftaran);
    }

    public function bukti_pendaftaran($id)
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
            )
            ->where('pendaftaran.id', $id)
            ->first();
        return view('pendaftaran.bukti_pendaftaran', compact('pendaftaran'));
    }
}
