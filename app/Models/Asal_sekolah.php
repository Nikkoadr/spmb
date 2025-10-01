<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asal_sekolah extends Model
{
    protected $guarded = [];
    protected $table = 'asal_sekolah';

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_asal_sekolah');
    }

    public function jenis_asal_sekolah()
    {
        return $this->belongsTo(Jenis_asal_sekolah::class, 'id_jenis_asal_sekolah');
    }

    public function status_asal_sekolah()
    {
        return $this->belongsTo(Status_asal_sekolah::class, 'id_status_asal_sekolah');
    }
}
