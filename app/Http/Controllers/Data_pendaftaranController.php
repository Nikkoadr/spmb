<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use App\Models\Asal_sekolah;
use App\Models\Jenis_kelamin;
use App\Models\Status_orang_tua;
use App\Models\Konsentrasi_keahlian;
use Illuminate\Http\Request;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use App\Models\Periode;
use Illuminate\Support\Str;

class Data_pendaftaranController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pendaftaran = Pendaftaran::with([
            'asal_sekolah',
            'konsentrasi_keahlian',
            'status_orang_tua',
            'jenis_kelamin',
            'status_siswa',
            'ukuran_seragam_siswa_baru',
        ])
            ->latest('created_at')
            ->get();

        return view('admin.data_pendaftaran.view_data_pendaftaran', compact('pendaftaran'));
    }

    public function form_tambah_pendaftaran()
    {
        $periode = Periode::latest('created_at')->first();
        $jenis_kelamin = Jenis_kelamin::all();
        $asal_sekolah = Asal_sekolah::all();
        $status_orang_tua = Status_orang_tua::all();
        $konsentrasi_keahlian = Konsentrasi_keahlian::all();

        return view('admin.data_pendaftaran.form_tambah_pendaftaran_admin', compact(
            'jenis_kelamin',
            'asal_sekolah',
            'status_orang_tua',
            'konsentrasi_keahlian',
            'periode'
        ));
    }

    public function proses_pendaftaran_admin(Request $request)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'nisn'                   => 'nullable|string|max:20',
            'no_kk'                  => 'nullable|string|max:20',
            'no_nik'                 => 'nullable|string|max:20',
            'nama'                   => [
                'required',
                'string',
                'max:100',
                Rule::unique('pendaftaran')->where(
                    fn($q) => $q->where('tanggal_lahir', $request->tanggal_lahir)
                ),
            ],
            'id_jenis_kelamin'       => 'required|integer|exists:jenis_kelamin,id',
            'id_asal_sekolah'        => 'nullable|integer|exists:asal_sekolah,id',
            'id_status_orang_tua'    => 'nullable|integer|exists:status_orang_tua,id',
            'id_konsentrasi_keahlian' => 'required|integer|exists:konsentrasi_keahlian,id',
            'tempat_lahir'           => 'required|string|max:50',
            'tanggal_lahir'          => 'required|date|before:today',

            // hanya untuk buat sekolah baru (jangan ikut simpan ke pendaftaran)
            'nama_asal_sekolah'      => 'nullable|string|max:100',

            'nik_ayah'               => 'nullable|string|max:20',
            'nama_ayah'              => 'nullable|string|max:100',
            'pekerjaan_ayah'         => 'nullable|string|max:100',
            'nik_ibu'                => 'nullable|string|max:20',
            'nama_ibu'               => 'nullable|string|max:100',
            'pekerjaan_ibu'          => 'nullable|string|max:100',
            'no_siswa'               => 'required|string|max:20',
            'no_wali_siswa'          => 'nullable|string|max:20',
            'blok'                   => 'nullable|string|max:100',
            'rt'                     => 'nullable|numeric',
            'rw'                     => 'nullable|numeric',
            'desa'                   => 'nullable|string|max:100',
            'kecamatan'              => 'nullable|string|max:100',
            'kabupaten'              => 'nullable|string|max:100',
            'referensi'              => 'nullable|string|max:255',
        ]);

        // 2. Pisahkan nama_asal_sekolah agar tidak masuk ke tabel pendaftaran
        $namaAsalSekolah = $validated['nama_asal_sekolah'] ?? null;
        unset($validated['nama_asal_sekolah']);

        // 3. Jika id_asal_sekolah kosong → buat sekolah baru
        if (empty($validated['id_asal_sekolah']) && $namaAsalSekolah) {
            $asal = Asal_sekolah::create([
                'nama_asal_sekolah' => $namaAsalSekolah,
            ]);
            $validated['id_asal_sekolah'] = $asal->id;
        }

        // 4. Ambil periode terbaru
        $periode = Periode::latest()->first();
        if (!$periode) {
            return back()->with('error', 'Periode belum tersedia, hubungi admin.');
        }

        // 5. Generate nomor pendaftaran unik
        $validated['no_pendaftaran'] = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $validated['id_periode']     = $periode->id;
        $validated['id_status_siswa'] = 1;

        // 6. Simpan ke tabel pendaftaran
        $pendaftaran = Pendaftaran::create($validated);

        // 7. Redirect ke bukti pendaftaran
        return redirect()->route('data_pendaftaran')
            ->with('success', 'Pendaftaran berhasil disimpan!');
    }

    public function form_edit_pendaftaran_admin($id)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->leftJoin('asal_sekolah', 'pendaftaran.id_asal_sekolah', '=', 'asal_sekolah.id')
            ->select('pendaftaran.*', 'asal_sekolah.nama_asal_sekolah')
            ->where('pendaftaran.id', $id)
            ->first();
        $periode = DB::table('periode')->get();
        $jenis_kelamin = DB::table('jenis_kelamin')->get();
        $konsentrasi_keahlian = DB::table('konsentrasi_keahlian')->get();
        $asal_sekolah = DB::table('asal_sekolah')->get();
        $status_orang_tua = DB::table('status_orang_tua')->get();
        $status_siswa = DB::table('status_siswa')->get();
        return view('admin.data_pendaftaran.form_edit_pendaftaran_admin', compact('pendaftaran', 'periode', 'jenis_kelamin', 'konsentrasi_keahlian', 'asal_sekolah', 'status_orang_tua', 'status_siswa'));
    }

    public function update_pendaftaran_admin(Request $request, $id)
    {
        $request->validate([
            'id_status_siswa' => 'required|integer|exists:status_siswa,id',
            'nisn' => 'nullable|string|max:20',
            'no_kk' => 'nullable|string|max:20',
            'no_nik' => 'nullable|string|max:20',
            'nama' => 'required|string|max:100',
            'id_jenis_kelamin' => 'required|integer|exists:jenis_kelamin,id',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date|before:today',
            'id_asal_sekolah' => 'nullable|integer|exists:asal_sekolah,id',
            'nik_ayah' => 'nullable|string|max:20',
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:100',
            'nik_ibu' => 'nullable|string|max:20',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:100',
            'id_status_orang_tua' => 'nullable|integer|exists:status_orang_tua,id',
            'no_siswa' => 'nullable|string|max:20',
            'no_wali_siswa' => 'nullable|string|max:20',
            'blok' => 'nullable|string|max:100',
            'rt' => 'nullable|numeric',
            'rw' => 'nullable|numeric',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'id_konsentrasi_keahlian' => 'required|integer|exists:konsentrasi_keahlian,id',
            'referensi' => 'nullable|string|max:100',
        ]);
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->update([
            'id_status_siswa' => $request->id_status_siswa,
            'nisn' => $request->nisn,
            'no_kk' => $request->no_kk,
            'no_nik' => $request->no_nik,
            'nama' => $request->nama,
            'id_jenis_kelamin' => $request->id_jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_asal_sekolah' => $request->id_asal_sekolah,
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
        ]);
        return redirect('/data_pendaftaran')->with('success', 'Data pendaftaran berhasil diupdate.');
    }

    public function cetak_pendaftaran($id)
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
            )->where('pendaftaran.id', $id)
            ->first();
        return view('pendaftaran.scan_pendaftaran', compact('pendaftaran'));
    }
    public function hapus($id)
    {
        DB::table('ukuran_seragam_siswa_baru')->where('id_pendaftaran', $id)->delete();
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->delete();
        return redirect('/data_pendaftaran')->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    public function download()
    {
        $nama_file = 'data_pendaftaran-' . date('Y-m-d') . '.xlsx';
        return Excel::download(new PendaftaranExport, $nama_file);
    }
}
