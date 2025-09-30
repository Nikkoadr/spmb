<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $guarded = [];

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
    public function asal_sekolah()
    {
        return $this->belongsTo(Asal_sekolah::class, 'id_asal_sekolah');
    }

    public function konsentrasi_keahlian()
    {
        return $this->belongsTo(Konsentrasi_keahlian::class, 'id_konsentrasi_keahlian');
    }

    public function status_orang_tua()
    {
        return $this->belongsTo(Status_orang_tua::class, 'id_status_orang_tua');
    }

    public function jenis_kelamin()
    {
        return $this->belongsTo(Jenis_kelamin::class, 'id_jenis_kelamin');
    }


    public function status_siswa()
    {
        return $this->belongsTo(Status_siswa::class, 'id_status_siswa');
    }
    public function ukuran_seragam_siswa_baru()
    {
        return $this->hasOne(Ukuran_seragam_siswa_baru::class, 'id_pendaftaran');
    }
}
