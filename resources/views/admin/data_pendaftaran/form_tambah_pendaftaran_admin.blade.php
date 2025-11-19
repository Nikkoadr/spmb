@extends('layouts.admin.main_admin')

@section('link')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<style>
    .suggestions {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ddd;
        max-height: 200px;
        overflow-y: auto;
        width: 100%;
        z-index: 1000;
    }
    .suggestion-item {
        padding: 8px;
        cursor: pointer;
    }
    .suggestion-item:hover {
        background-color: #f0f0f0;
    }
    .note { font-size: 0.9rem; color: #666; }
</style>
@endsection

@section('title', 'Form Tambah Pendaftar')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Data PPDB</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Form Tambah Pendaftar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Form Tambah Pendaftar</h3></div>
                <div class="card-body">
                    <form action="/data_pendaftaran/proses" method="POST">
                        @csrf

                        {{-- Periode --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">Periode :</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="{{ $periode->tahun_ajaran ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" value="{{ $periode->periode_aktif ?? '-' }}" readonly>
                            </div>
                        </div>

                        {{-- Identitas Siswa --}}
                        <div class="form-group row">
                            <label for="nisn" class="col-md-3 col-form-label text-md-right">NISN :</label>
                            <div class="col-md-9">
                                <input type="number" name="nisn" id="nisn"
                                    class="form-control @error('nisn') is-invalid @enderror"
                                    placeholder="Masukkan NISN" value="{{ old('nisn') }}">
                                @error('nisn')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_kk" class="col-md-3 col-form-label text-md-right">No KK :</label>
                            <div class="col-md-9">
                                <input type="number" name="no_kk" id="no_kk"
                                    class="form-control @error('no_kk') is-invalid @enderror"
                                    placeholder="Masukkan No KK" value="{{ old('no_kk') }}">
                                @error('no_kk')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_nik" class="col-md-3 col-form-label text-md-right">No NIK :</label>
                            <div class="col-md-9">
                                <input type="number" name="no_nik" id="no_nik"
                                    class="form-control @error('no_nik') is-invalid @enderror"
                                    placeholder="Masukkan No NIK" value="{{ old('no_nik') }}">
                                @error('no_nik')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama" class="col-md-3 col-form-label text-md-right">Nama : <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input required oninput="this.value = this.value.toUpperCase()" type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                                @error('nama')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="form-group row">
                            <label for="id_jenis_kelamin" class="col-md-3 col-form-label text-md-right">Jenis Kelamin : <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select required name="id_jenis_kelamin" id="id_jenis_kelamin" class="form-control @error('id_jenis_kelamin') is-invalid @enderror">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    @foreach ($jenis_kelamin as $jk)
                                        <option value="{{ $jk->id }}" {{ old('id_jenis_kelamin') == $jk->id ? 'selected' : '' }}>
                                            {{ $jk->nama_jenis_kelamin }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jenis_kelamin')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Tempat & Tanggal Lahir --}}
                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-md-3 col-form-label text-md-right">Tempat Lahir : <span class="text-danger">*</span></label>
                            <div class="col-md-5">
                                <input required oninput="this.value = this.value.toUpperCase()" type="text" name="tempat_lahir" id="tempat_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" placeholder="Tempat Lahir">
                                @error('tempat_lahir')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-4">
                                <input required type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                                @error('tanggal_lahir')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Asal Sekolah (autocomplete) --}}
                        <div class="form-group row" style="position: relative;">
                            <label for="nama_asal_sekolah" class="col-md-3 col-form-label text-md-right">Asal Sekolah : <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="nama_asal_sekolah" id="nama_asal_sekolah"
                                    class="form-control @error('nama_asal_sekolah') is-invalid @enderror"
                                    placeholder="Nama Asal Sekolah" value="{{ old('nama_asal_sekolah') }}" autocomplete="off" required>
                                <input type="hidden" id="id_asal_sekolah" name="id_asal_sekolah" value="{{ old('id_asal_sekolah') }}">
                                <div id="suggestions" class="suggestions"></div>
                                @error('nama_asal_sekolah')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Data Orang Tua --}}
                        <h5 class="mt-3"><b>Data Orang Tua</b></h5>

                        <div class="form-group row">
                            <label for="nik_ayah" class="col-md-3 col-form-label text-md-right">NIK Ayah :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" id="nik_ayah" type="number" name="nik_ayah"
                                    class="form-control @error('nik_ayah') is-invalid @enderror" value="{{ old('nik_ayah') }}" placeholder="NIK Ayah">
                                @error('nik_ayah')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_ayah" class="col-md-3 col-form-label text-md-right">Nama Ayah :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" id="nama_ayah" type="text" name="nama_ayah"
                                    class="form-control @error('nama_ayah') is-invalid @enderror" value="{{ old('nama_ayah') }}" placeholder="Nama Ayah">
                                @error('nama_ayah')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pekerjaan_ayah" class="col-md-3 col-form-label text-md-right">Pekerjaan Ayah :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" id="pekerjaan_ayah" type="text" name="pekerjaan_ayah"
                                    class="form-control @error('pekerjaan_ayah') is-invalid @enderror" value="{{ old('pekerjaan_ayah') }}" placeholder="Pekerjaan Ayah">
                                @error('pekerjaan_ayah')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nik_ibu" class="col-md-3 col-form-label text-md-right">NIK Ibu :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" id="nik_ibu" type="number" name="nik_ibu"
                                    class="form-control @error('nik_ibu') is-invalid @enderror" value="{{ old('nik_ibu') }}" placeholder="NIK Ibu">
                                @error('nik_ibu')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_ibu" class="col-md-3 col-form-label text-md-right">Nama Ibu :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" id="nama_ibu" type="text" name="nama_ibu"
                                    class="form-control @error('nama_ibu') is-invalid @enderror" value="{{ old('nama_ibu') }}" placeholder="Nama Ibu">
                                @error('nama_ibu')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pekerjaan_ibu" class="col-md-3 col-form-label text-md-right">Pekerjaan Ibu :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" id="pekerjaan_ibu" type="text" name="pekerjaan_ibu"
                                    class="form-control @error('pekerjaan_ibu') is-invalid @enderror" value="{{ old('pekerjaan_ibu') }}" placeholder="Pekerjaan Ibu">
                                @error('pekerjaan_ibu')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_status_orang_tua" class="col-md-3 col-form-label text-md-right">Status Orang Tua :</label>
                            <div class="col-md-9">
                                <select name="id_status_orang_tua" id="id_status_orang_tua" class="form-control @error('id_status_orang_tua') is-invalid @enderror">
                                    <option value="">Pilih Status Orang Tua</option>
                                    @foreach($status_orang_tua as $status)
                                        <option value="{{ $status->id }}" {{ old('id_status_orang_tua') == $status->id ? 'selected' : '' }}>
                                            {{ $status->nama_status_orang_tua }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_status_orang_tua')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <h5 class="mt-3"><b>Alamat</b></h5>

                        <div class="form-group row">
                            <label for="blok" class="col-md-3 col-form-label text-md-right">Blok :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" type="text" id="blok" name="blok"
                                    class="form-control @error('blok') is-invalid @enderror" value="{{ old('blok') }}" placeholder="Blok">
                                @error('blok')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 col-form-label text-md-right">RT / RW :</label>
                            <div class="col-md-3">
                                <input type="number" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" value="{{ old('rt') }}" placeholder="RT">
                                @error('rt')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror" value="{{ old('rw') }}" placeholder="RW">
                                @error('rw')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div class="form-group row">
                            <label for="desa" class="col-md-3 col-form-label text-md-right">Desa :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" type="text" id="desa" name="desa"
                                    class="form-control @error('desa') is-invalid @enderror" value="{{ old('desa') }}" placeholder="Desa">
                                @error('desa')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kecamatan" class="col-md-3 col-form-label text-md-right">Kecamatan :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" type="text" id="kecamatan" name="kecamatan"
                                    class="form-control @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan') }}" placeholder="Kecamatan">
                                @error('kecamatan')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kabupaten" class="col-md-3 col-form-label text-md-right">Kabupaten :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" type="text" id="kabupaten" name="kabupaten"
                                    class="form-control @error('kabupaten') is-invalid @enderror" value="{{ old('kabupaten') }}" placeholder="Kabupaten">
                                @error('kabupaten')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Kontak --}}
                        <h5 class="mt-3"><b>Kontak</b></h5>

                        <div class="form-group row">
                            <label for="no_siswa" class="col-md-3 col-form-label text-md-right">Nomor HP Siswa : <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input required type="text" id="no_siswa" name="no_siswa"
                                    class="form-control @error('no_siswa') is-invalid @enderror" value="{{ old('no_siswa') }}" placeholder="08xxxxxxxxxx">
                                @error('no_siswa')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_wali_siswa" class="col-md-3 col-form-label text-md-right">Nomor HP Orang Tua :</label>
                            <div class="col-md-9">
                                <input type="text" id="no_wali_siswa" name="no_wali_siswa"
                                    class="form-control @error('no_wali_siswa') is-invalid @enderror" value="{{ old('no_wali_siswa') }}" placeholder="08xxxxxxxxxx">
                                @error('no_wali_siswa')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Jurusan --}}
                        <div class="form-group row">
                            <label for="id_konsentrasi_keahlian" class="col-md-3 col-form-label text-md-right">Jurusan / Konsentrasi Keahlian : <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select required name="id_konsentrasi_keahlian" id="id_konsentrasi_keahlian"
                                    class="form-control @error('id_konsentrasi_keahlian') is-invalid @enderror">
                                    <option value="">Pilih Konsentrasi Keahlian</option>
                                    @foreach ($konsentrasi_keahlian as $konsentrasi)
                                        <option value="{{ $konsentrasi->id }}" {{ old('id_konsentrasi_keahlian') == $konsentrasi->id ? 'selected' : '' }}>
                                            {{ $konsentrasi->nama_konsentrasi_keahlian }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_konsentrasi_keahlian')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Referensi --}}
                        <div class="form-group row">
                            <label for="referensi" class="col-md-3 col-form-label text-md-right">Referensi :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()" id="referensi" type="text" name="referensi"
                                    class="form-control @error('referensi') is-invalid @enderror" value="{{ old('referensi') }}" placeholder="Ex : Adi Permana 12-TKJ-2">
                                @error('referensi')<span class="invalid-feedback"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        {{-- Reminder --}}
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <p class="note float-right">Field bertanda <span class="text-danger">*</span> wajib diisi.</p>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Daftar</button>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
            </div>
        </div>
    </div>
    </section>
</div>
@endsection

@section('script')
<!-- load jquery first -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/adminlte.min.js') }}"></script>

{{-- Autocomplete Asal Sekolah --}}
<script>
(function () {
    const input = document.getElementById('nama_asal_sekolah');
    const suggestions = document.getElementById('suggestions');
    const hiddenId = document.getElementById('id_asal_sekolah');

    if (!input) return;

    let controller = null; // to abort previous fetch if needed

    input.addEventListener('input', function () {
        const q = this.value.trim();
        hiddenId.value = '';

        if (controller) controller.abort();
        if (q.length <= 1) {
            suggestions.innerHTML = '';
            suggestions.style.display = 'none';
            return;
        }

        controller = new AbortController();
        fetch(`/get_asal_sekolah?query=${encodeURIComponent(q)}`, { signal: controller.signal })
            .then(res => res.json())
            .then(data => {
                suggestions.innerHTML = '';
                if (!Array.isArray(data) || data.length === 0) {
                    suggestions.style.display = 'none';
                    return;
                }

                data.forEach(item => {
                    const d = document.createElement('div');
                    d.className = 'suggestion-item';
                    d.textContent = item.nama_asal_sekolah;
                    d.addEventListener('click', () => {
                        input.value = item.nama_asal_sekolah;
                        hiddenId.value = item.id;
                        suggestions.innerHTML = '';
                        suggestions.style.display = 'none';
                    });
                    suggestions.appendChild(d);
                });

                suggestions.style.display = 'block';
            })
            .catch(err => {
                if (err.name === 'AbortError') return;
                console.error(err);
                suggestions.innerHTML = '';
                suggestions.style.display = 'none';
            });
    });

    // close suggestions when clicking outside
    document.addEventListener('click', (e) => {
        if (!suggestions.contains(e.target) && e.target !== input) {
            suggestions.style.display = 'none';
        }
    });
})();
</script>

{{-- SweetAlert --}}
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
@if (session()->has('success'))
    Swal.fire({ title: "Sukses!", text: "{{ session('success') }}", icon: "success" });
@elseif (session()->has('error'))
    Swal.fire({ title: "Maaf!", text: "{{ session('error') }}", icon: "error" });
@endif
</script>
@endsection
