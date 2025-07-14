<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Data_priodeController extends Controller
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
        $data_periode = DB::table('periode')
        ->orderBy('created_at', 'asc')
        ->get();
        return view('admin.data_periode.view_data_periode', compact('data_periode'));
    }
    public function form_tambah_periode()
        {
            return view('admin.data_periode.form_tambah_periode_admin');
        }

    public function proses_tambah_periode(Request $request)
        {
            $request->validate([
                'tahun_ajaran' => 'required',
                'periode_aktif' => 'required',
            ]);

            DB::table('periode')->insert([
                'tahun_ajaran' => $request->tahun_ajaran,
                'periode_aktif' => $request->periode_aktif,
                'created_at' => now(),
            ]);
            return redirect('/data_priode')->with('success', 'Data periode berhasil ditambahkan.');
        }

    public function view_edit_periode($id)
        {
            $data_periode = DB::table('periode')->where('id', $id)->first();
            return view('admin.data_periode.form_edit_periode_admin', compact('data_periode'));
        }   
    public function update_priode(Request $request, $id)
        {
            $request->validate([
                'tahun_ajaran' => 'required',
                'periode_aktif' => 'required',
            ]);
            DB::table('periode')->where('id', $id)->update([
                'tahun_ajaran' => $request->tahun_ajaran,
                'periode_aktif' => $request->periode_aktif,
            ]);
            return redirect('/data_priode')->with('success', 'Data periode berhasil diupdate.');
        }
        public function hapus_periode($id)
        {
            DB::table('pendaftaran')->where('id_periode', $id)->delete();
            DB::table('periode')->where('id', $id)->delete();
            return redirect()->back();
        }
}
