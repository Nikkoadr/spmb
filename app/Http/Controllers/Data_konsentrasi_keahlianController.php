<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsentrasi_keahlian;

class Data_konsentrasi_keahlianController extends Controller
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
        $data_konsentrasi_keahlian = Konsentrasi_keahlian::all();
        return view('admin.data_konsentrasi_keahlian.view_data_konsentrasi_keahlian', compact('data_konsentrasi_keahlian'));
    }

    public function form_tambah_konsentrasi_keahlian()
    {
        return view('admin.data_konsentrasi_keahlian.form_tambah_konsentrasi_keahlian_admin');
    }

    public function proses_tambah_konsentrasi_keahlian(Request $request)
    {
        $request->validate([
            'nama_konsentrasi_keahlian' => 'required',
        ]);

        Konsentrasi_keahlian::create([
            'nama_konsentrasi_keahlian' => $request->nama_konsentrasi_keahlian,
        ]);

        return redirect('/data_konsentrasi_keahlian')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function form_edit_konsentrasi_keahlian($id)
    {
        $data = Konsentrasi_keahlian::findOrFail($id);
        return view('admin.data_konsentrasi_keahlian.form_edit_konsentrasi_keahlian_admin', compact('data'));
    }

    public function update_konsentrasi_keahlian(Request $request, $id)
    {
        $request->validate([
            'nama_konsentrasi_keahlian' => 'required',
        ]);

        $data = Konsentrasi_keahlian::findOrFail($id);
        $data->update([
            'nama_konsentrasi_keahlian' => $request->nama_konsentrasi_keahlian,
        ]);

        return redirect('/data_konsentrasi_keahlian')->with('success', 'Data Berhasil Diupdate');
    }

    public function hapus_konsentrasi_keahlian($id)
    {
        $data = Konsentrasi_keahlian::findOrFail($id);
        $data->delete();

        return redirect('/data_konsentrasi_keahlian')->with('success', 'Data Berhasil Dihapus');
    }
}
