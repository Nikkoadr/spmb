<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsentrasi_keahlian extends Model
{
    protected $table = 'konsentrasi_keahlian';
    protected $guarded = [];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_konsentrasi_keahlian');
    }
}
