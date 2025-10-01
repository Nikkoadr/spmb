<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran_seragam_siswa_baru extends Model
{
    protected $guarded = [];
    protected $table = 'ukuran_seragam_siswa_baru';

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
    }
}
