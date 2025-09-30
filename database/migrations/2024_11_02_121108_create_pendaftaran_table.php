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

            // Relasi ke periode
            $table->foreignId('id_periode')
                ->nullable()
                ->constrained('periode')
                ->onDelete('set null');

            $table->string('no_pendaftaran')->unique();

            // Status siswa
            $table->foreignId('id_status_siswa')
                ->nullable()
                ->constrained('status_siswa')
                ->onDelete('set null');

            // Data siswa
            $table->string('nisn', 20)->nullable();
            $table->string('no_kk', 20)->nullable();
            $table->string('no_nik', 20)->nullable();
            $table->string('nama', 100);

            $table->foreignId('id_jenis_kelamin')
                ->nullable()
                ->constrained('jenis_kelamin')
                ->onDelete('set null');

            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();

            // Asal sekolah
            $table->foreignId('id_asal_sekolah')
                ->nullable()
                ->constrained('asal_sekolah')
                ->onDelete('set null');

            // Data orang tua
            $table->string('nik_ayah', 20)->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->string('pekerjaan_ayah', 100)->nullable();
            $table->string('nik_ibu', 20)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->string('pekerjaan_ibu', 100)->nullable();

            $table->foreignId('id_status_orang_tua')
                ->nullable()
                ->constrained('status_orang_tua')
                ->onDelete('set null');

            // Alamat
            $table->string('blok', 100)->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kabupaten', 100)->nullable();

            // Kontak
            $table->string('no_siswa', 20)->nullable();
            $table->string('no_wali_siswa', 20)->nullable();

            // Konsentrasi keahlian
            $table->foreignId('id_konsentrasi_keahlian')
                ->nullable()
                ->constrained('konsentrasi_keahlian')
                ->onDelete('set null');

            $table->string('referensi', 255)->nullable();

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
