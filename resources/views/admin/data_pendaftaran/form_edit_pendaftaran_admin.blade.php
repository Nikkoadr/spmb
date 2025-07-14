@extends('layouts.admin.main_admin')
@section('link')
<!-- DataTables -->
<link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<style>
    .suggestions {
    display: none; /* Sembunyikan secara default */
    position: absolute;
    background-color: white;
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
</style>
@endsection
@section('title')
    {{'Form Tambah Pendaftar'}}
@endsection
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data SPMB</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Form Edit Pendaftar</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->
    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Form Edit Pendaftar</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/data_pendaftaran/update/{{ $pendaftaran->id }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="id_status_siswa" class="col-md-3 col-form-label text-md-right">Status Siswa :</label>
                        <div class="col-md-9">
                            <select name="id_status_siswa" id="id_status_siswa" class="form-control @error('id_status_siswa') is-invalid @enderror" id="id_status_siswa">
                                @foreach ($status_siswa as $row)
                                    <option value="{{ $row->id }}" {{ $pendaftaran->id_status_siswa == $row->id ? 'selected' : '' }}>{{ $row->nama_status_siswa }}</option>
                                @endforeach
                            </select>
                            @error('id_status_siswa')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="periode" class="col-md-3 col-form-label text-md-right">Periode :</label>
                        <div class="col-md-9">
                            <select name="id_periode" id="id_periode" class="form-control @error('id_periode') is-invalid @enderror" id="id_periode">
                                @foreach ($periode as $row)
                                    <option value="{{ $row->id }}" {{ $pendaftaran->id_periode == $row->id ? 'selected' : '' }}>{{ $row->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                            @error('periode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nisn" class="col-md-3 col-form-label text-md-right">NISN :</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn"  value="{{ $pendaftaran->nisn }}">
                            @error('nisn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_kk" class="col-md-3 col-form-label text-md-right">No KK :</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" name="no_kk" value="{{ $pendaftaran->no_kk }}">
                            @error('no_kk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_nik" class="col-md-3 col-form-label text-md-right">No NIK :</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control @error('no_nik') is-invalid @enderror" id="no_nik" name="no_nik"  value="{{ $pendaftaran->no_nik }}">
                            @error('no_nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label text-md-right">Nama : <span style="color: red">*</span></label>
                        <div class="col-md-9">
                            <input required oninput="this.value = this.value.toUpperCase()" type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $pendaftaran->nama }}">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_jenis_kelamin" class="col-md-3 col-form-label text-md-right">Jenis Kelamin : <span style="color: red">*</span></label>
                        <div class="col-md-9">
                            <select required class="form-control @error('id_jenis_kelamin') is-invalid @enderror" id="id_jenis_kelamin" name="id_jenis_kelamin">
                                <option value="">Pilih Jenis Kelamin</option>
                                @foreach ($jenis_kelamin as $jk)
                                    <option value="{{ $jk->id }}" {{ $pendaftaran->id_jenis_kelamin == $jk->id ? 'selected' : '' }}>{{ $jk->nama_jenis_kelamin }}</option>
                                @endforeach
                            </select>
                            @error('id_jenis_kelamin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-md-3 col-form-label text-md-right">Tempat Lahir : <span style="color: red">*</span></label>
                        <div class="col-md-9">
                            <input required oninput="this.value = this.value.toUpperCase()" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ $pendaftaran->tempat_lahir }}">
                            @error('tempat_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-md-3 col-form-label text-md-right">Tanggal Lahir : <span style="color: red">*</span></label>
                        <div class="col-md-9">
                            <input required type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ $pendaftaran->tanggal_lahir }}">
                            @error('tanggal_lahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-grup row">
                    <label for="nama_asal_sekolah" class="col-md-3 col-form-label text-md-right">Asal Sekolah : <span style="color: red">*</span></label>
                    <div class="col-md-9">
                        <input 
                            class="form-control @error('nama_asal_sekolah') is-invalid @enderror" 
                            type="text" 
                            id="nama_asal_sekolah" 
                            name="nama_asal_sekolah"
                            value="{{ $pendaftaran->nama_asal_sekolah }}"
                            autocomplete="off">
                        <input type="hidden" id="id_asal_sekolah" name="id_asal_sekolah" value="{{ $pendaftaran->id_asal_sekolah }}">
                        <div class="suggestions dropdown-item" id="suggestions"></div>
                        @error('nama_asal_sekolah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                        <h3><b>Data Orang Tua :</b></h3>
                        <div class="row mb-3">
                            <label for="nik_ayah" class="col-md-3 col-form-label text-md-right">NIK Ayah :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  id="nik_ayah" type="text" class="form-control @error('nik_ayah') is-invalid @enderror" name="nik_ayah" value="{{ $pendaftaran->nik_ayah }}">
                                @error('nik_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_ayah" class="col-md-3 col-form-label text-md-right">Nama Ayah :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  id="nama_ayah" type="text" class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah" value="{{ $pendaftaran->nama_ayah }}">
                                @error('nama_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pekerjaan_ayah" class="col-md-3 col-form-label text-md-right">Pekerjaan Ayah :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  id="pekerjaan_ayah" type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror" name="pekerjaan_ayah" value="{{ $pendaftaran->pekerjaan_ayah }}">
                                @error('pekerjaan_ayah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik_ibu" class="col-md-3 col-form-label text-md-right">NIK Ibu :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  id="nik_ibu" type="text" class="form-control @error('nik_ibu') is-invalid @enderror" name="nik_ibu" value="{{ $pendaftaran->nik_ibu }}">
                                @error('nik_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_ibu" class="col-md-3 col-form-label text-md-right">Nama Ibu :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  id="nama_ibu" type="text" class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu" value="{{ $pendaftaran->nama_ibu }}">
                                @error('nama_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pekerjaan_ibu" class="col-md-3 col-form-label text-md-right">Pekerjaan Ibu :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  id="pekerjaan_ibu" type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror" name="pekerjaan_ibu" value="{{ $pendaftaran->pekerjaan_ibu }}"> 
                                @error('pekerjaan_ibu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_status_orang_tua" class="col-md-3 col-form-label text-md-right">Status Orang Tua :</label>
                            <div class="col-md-9">
                                <select name="id_status_orang_tua" id="status_orang_tua" class="form-control @error('id_status_orang_tua') is-invalid @enderror">
                                @foreach ($status_orang_tua as $row)
                                    <option value="{{ $row->id }}" {{ $pendaftaran->id_status_orang_tua == $row->id ? 'selected' : '' }}>{{ $row->nama_status_orang_tua }}</option>
                                @endforeach
                                </select>
                                @error('id_status_orang_tua')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <h3><b>Data Kontak :</b></h3>
                        <div class="form-group row">
                            <label for="no_siswa" class="col-md-3 col-form-label text-md-right">Nomor HP Siswa / Siswi : <span style="color: red">*</span></label>
                            <div class="col-md-9">
                                <input required id="no_siswa" type="number" class="form-control @error('no_siswa') is-invalid @enderror" name="no_siswa" value="{{ $pendaftaran->no_siswa }}" >
                                @error('no_siswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_wali_siswa" class="col-md-3 col-form-label text-md-right">Nomor HP Orang Tua :</label>
                            <div class="col-md-9">
                                <input id="no_wali_siswa" type="number" class="form-control @error('no_wali_siswa') is-invalid @enderror" 
                                name="no_wali_siswa" value="{{ $pendaftaran->no_wali_siswa }}">
                                @error('no_wali_siswa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-3 col-form-label text-md-right">Alamat :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  type="text" class="form-control @error('blok') is-invalid @enderror" 
                                name="blok" value="{{ $pendaftaran->blok }}" >
                                @error('blok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="number" class="form-control @error('rt') is-invalid @enderror" 
                                name="rt" value="{{ $pendaftaran->rt }}">
                                @error('rt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="number" class="form-control @error('rw') is-invalid @enderror" 
                                name="rw" value="{{ $pendaftaran->rw }}" >
                                @error('rw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input oninput="this.value = this.value.toUpperCase()"  type="text" class="form-control @error('desa') is-invalid @enderror" 
                                name="desa" value="{{ $pendaftaran->desa }}" >
                                @error('desa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input oninput="this.value = this.value.toUpperCase()"  type="text" class="form-control @error('kecamatan') is-invalid @enderror" 
                                name="kecamatan" value="{{ $pendaftaran->kecamatan }}">
                                @error('kecamatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input oninput="this.value = this.value.toUpperCase()"  type="text" class="form-control @error('kabupaten') is-invalid @enderror" 
                                name="kabupaten" value="{{ $pendaftaran->kabupaten }}">
                                @error('kabupaten')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_konsentrasi_keahlian" class="col-md-3 col-form-label text-md-right">Jurusan / Konsentrasi Keahlian : <span style="color: red">*</span> :</label>
                            <div class="col-md-9">
                                <select required name="id_konsentrasi_keahlian" id="id_konsentrasi_keahlian" class="form-control @error('id_konsentrasi_keahlian') is-invalid @enderror" required>
                                <option value="">Pilih Konsentrasi Keahlian</option>
                                @foreach ($konsentrasi_keahlian as $konsentrasi)
                                    <option value="{{ $konsentrasi->id }}" {{ $pendaftaran->id_konsentrasi_keahlian == $konsentrasi->id ? 'selected' : '' }}>{{ $konsentrasi->nama_konsentrasi_keahlian }}</option>
                                @endforeach
                                </select>
                                @error('id_konsentrasi_keahlian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="referensi" class="col-md-3 col-form-label text-md-right">Referensi :</label>
                            <div class="col-md-9">
                                <input oninput="this.value = this.value.toUpperCase()"  id="referensi" type="text" class="form-control @error('referensi') is-invalid @enderror" name="referensi" value="{{ $pendaftaran->referensi }}">
                                @error('referensi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <label class="float-right">Yang bertanda <span style="color: red">*</span> wajib diisi</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
@section('script')
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/plugins/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script>
    document.getElementById('nama_asal_sekolah').addEventListener('input', function () {
        let query = this.value;
        let suggestions = document.getElementById('suggestions');

        document.getElementById('id_asal_sekolah').value = '';

        if (query.length > 1) {
            fetch(`/get_asal_sekolah?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    suggestions.innerHTML = '';
                    
                    if (data.length > 0) {
                        data.forEach(asal_sekolah => {
                            let suggestion = document.createElement('div');
                            suggestion.textContent = asal_sekolah.nama_asal_sekolah;
                            suggestion.classList.add('suggestion-item');
                            suggestion.addEventListener('click', function () {
                                document.getElementById('nama_asal_sekolah').value = asal_sekolah.nama_asal_sekolah;
                                document.getElementById('id_asal_sekolah').value = asal_sekolah.id;
                                suggestions.innerHTML = '';
                                suggestions.style.display = 'none';
                            });
                            suggestions.appendChild(suggestion);
                        });
                        suggestions.style.display = 'block';
                    } else {
                        suggestions.style.display = 'none';
                    }
                });
        } else {
            suggestions.innerHTML = '';
            suggestions.style.display = 'none';
        }
    });
</script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script>
    @if (session()->has('success'))
        Swal.fire({
            title: "Sukses!",
            text: "{{ session('success') }}",
            icon: "success"
        });
    @elseif (session()->has('error'))
        Swal.fire({
            title: "Maaf!",
            text: "{{ session('error') }}",
            icon: "error"
        });
    @endif
</script>
@endsection