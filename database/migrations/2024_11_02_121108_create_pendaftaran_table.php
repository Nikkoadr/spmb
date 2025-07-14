<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('id_periode')->nullable();
            $table->string('no_pendaftaran');
            $table->foreignId('id_status_siswa')->nullable()->index()->references('id')->on('status_siswa');
            $table->string('nisn')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('no_nik')->nullable();
            $table->string('nama')->nullable();
            $table->foreignId('id_jenis_kelamin')->nullable()->index()->references('id')->on('jenis_kelamin');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->foreignId('id_asal_sekolah')->nullable()->index()->references('id')->on('asal_sekolah');
            $table->string('nik_ayah')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->foreignId('id_status_orang_tua')->nullable()->index()->references('id')->on('status_orang_tua');
            $table->string('blok')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('no_siswa')->nullable();
            $table->string('no_wali_siswa')->nullable();
            $table->foreignId('id_konsentrasi_keahlian')->nullable()->index()->references('id')->on('konsentrasi_keahlian');
            $table->string('referensi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
