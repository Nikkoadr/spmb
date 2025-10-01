<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Data_ukuran_seragamExport;
use App\Models\Pendaftaran;
use App\Models\Ukuran_seragam_siswa_baru;

class Data_ukuran_seragamController extends Controller
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
        $data_ukuran_seragam = Pendaftaran::with([
            'ukuran_seragam_siswa_baru',
            'jenis_kelamin',
            'asal_sekolah'
        ])->get();

        return view('admin.data_ukuran_seragam.view_data_ukuran_seragam', compact('data_ukuran_seragam'));
    }

    public function form_tambah_ukuran_seragam($code)
    {
        $data = Pendaftaran::where('no_pendaftaran', $code)->firstOrFail();
        return view('admin.data_ukuran_seragam.form_tambah_ukuran_seragam_admin', compact('data'));
    }

    public function form_edit_ukuran_seragam($id)
    {
        $data_ukuran_seragam = Ukuran_seragam_siswa_baru::with('pendaftaran')
            ->findOrFail($id);

        return view(
            'admin.data_ukuran_seragam.form_edit_ukuran_seragam_admin',
            compact("data_ukuran_seragam")
        );
    }

    public function update_ukuran_seragam(Request $request, $id)
    {
        $request->validate([
            'ukuran_baju' => 'required',
            'ukuran_panjang_celana' => 'required',
            'ukuran_lingkar_pinggang_celana' => 'required',
            'ukuran_sepatu' => 'required'
        ]);

        $ukuran = Ukuran_seragam_siswa_baru::findOrFail($id);

        $ukuran->update([
            'ukuran_baju' => $request->ukuran_baju,
            'ukuran_panjang_celana' => $request->ukuran_panjang_celana,
            'ukuran_lingkar_pinggang_celana' => $request->ukuran_lingkar_pinggang_celana,
            'ukuran_sepatu' => $request->ukuran_sepatu,
        ]);

        return redirect('/data_ukuran_seragam')
            ->with('success', 'Data ukuran baju, celana, dan sepatu berhasil diupdate.');
    }

    public function hapus_ukuran_seragam($id)
    {
        $ukuran = Ukuran_seragam_siswa_baru::findOrFail($id);
        $ukuran->delete();

        return redirect('/data_ukuran_seragam')
            ->with('success', 'Data ukuran seragam berhasil dihapus.');
    }

    public function download()
    {
        $nama_file = 'data_seragam-' . date('Y-m-d') . '.xlsx';
        return Excel::download(new Data_ukuran_seragamExport, $nama_file);
    }
}
