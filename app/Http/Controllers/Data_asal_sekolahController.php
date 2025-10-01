<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Asal_sekolah;
use App\Models\Jenis_asal_sekolah;
use App\Models\Status_asal_sekolah;


class Data_asal_sekolahController extends Controller
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
        $data_asal_sekolah = Asal_sekolah::with(['jenis_asal_sekolah', 'status_asal_sekolah'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.data_asal_sekolah.view_data_asal_sekolah', compact('data_asal_sekolah'));
    }

    public function form_tambah_asal_sekolah()
    {
        $jenis_asal_sekolah = Jenis_asal_sekolah::all();
        $status_asal_sekolah = Status_asal_sekolah::all();

        return view('admin.data_asal_sekolah.form_tambah_asal_sekolah_admin', compact('jenis_asal_sekolah', 'status_asal_sekolah'));
    }

    public function proses_tambah_asal_sekolah(Request $request)
    {
        $request->validate([
            'id_jenis_asal_sekolah' => 'required',
            'id_status_asal_sekolah' => 'required',
            'nama_asal_sekolah' => 'required',
        ]);

        Asal_sekolah::create([
            'npsn' => $request->npsn,
            'id_jenis_asal_sekolah' => $request->id_jenis_asal_sekolah,
            'id_status_asal_sekolah' => $request->id_status_asal_sekolah,
            'nama_asal_sekolah' => $request->nama_asal_sekolah,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
        ]);

        return redirect()->route('data_asal_sekolah.index')->with('success', 'Data asal sekolah berhasil ditambahkan!');
    }

    public function form_edit_asal_sekolah($id)
    {
        $data_asal_sekolah = Asal_sekolah::findOrFail($id);
        $jenis_asal_sekolah = Jenis_asal_sekolah::all();
        $status_asal_sekolah = Status_asal_sekolah::all();

        return view('admin.data_asal_sekolah.form_edit_asal_sekolah_admin', compact(
            'data_asal_sekolah',
            'jenis_asal_sekolah',
            'status_asal_sekolah'
        ));
    }

    public function update_asal_sekolah(Request $request, $id)
    {
        $request->validate([
            'id_jenis_asal_sekolah' => 'required',
            'id_status_asal_sekolah' => 'required',
            'nama_asal_sekolah' => 'required',
        ]);

        $asalSekolah = Asal_sekolah::findOrFail($id);

        $asalSekolah->update([
            'npsn' => $request->npsn,
            'id_jenis_asal_sekolah' => $request->id_jenis_asal_sekolah,
            'id_status_asal_sekolah' => $request->id_status_asal_sekolah,
            'nama_asal_sekolah' => $request->nama_asal_sekolah,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
        ]);

        return redirect()->route('data_asal_sekolah.index')
            ->with('success', 'Data asal sekolah berhasil diupdate!');
    }

    public function hapus_asal_sekolah($id)
    {
        // Cari data asal sekolah
        $asalSekolah = Asal_sekolah::findOrFail($id);

        // Cek apakah masih dipakai oleh siswa
        $siswaCount = Pendaftaran::where('id_asal_sekolah', $id)->count();

        if ($siswaCount > 0) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus: masih ada siswa yang terdaftar di sekolah ini.');
        }

        // Jika tidak dipakai, hapus
        $asalSekolah->delete();

        return redirect()->back()->with('success', 'Data asal sekolah berhasil dihapus!');
    }
}
