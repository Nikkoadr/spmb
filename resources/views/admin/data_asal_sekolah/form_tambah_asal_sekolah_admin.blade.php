@extends('layouts.admin.main_admin')
@section('link')
<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection
@section('title')
    {{'Form Tambah Periode'}}
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
            <li class="breadcrumb-item">Databases</li>
            <li class="breadcrumb-item">Asal Sekolah</li>
            <li class="breadcrumb-item active">Tambah</li>
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
            <h3 class="card-title">Form Tambah Asal Sekolah</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="/databases/proses_tambah_asal_sekolah" method="POST">
                    @csrf
                    <div class="form-group row">
                    <label for="npsn" class="col-md-2 col-form-label text-md-right">NPSN :</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" id="npsn" name="npsn" placeholder="Masukkan NPSN" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="id_jenis_asal_sekolah" class="col-md-2 col-form-label text-md-right">Jenis Sekolah :</label>
                        <div class="col-md-10">
                            <select class="form-control" name="id_jenis_asal_sekolah" id="id_jenis_asal_sekolah">
                                <option value="">-- Pilih Jenis Sekolah --</option>
                                @foreach ($jenis_asal_sekolah as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_jenis_asal_sekolah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="id_status_asal_sekolah" class="col-md-2 col-form-label text-md-right">Status Sekolah :</label>
                        <div class="col-md-10">
                            <select class="form-control" name="id_status_asal_sekolah" id="id_status_asal_sekolah">
                                <option value="">-- Pilih Status Sekolah --</option>
                                @foreach ($status_asal_sekolah as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_status_asal_sekolah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="nama_asal_sekolah" class="col-md-2 col-form-label text-md-right">Nama Asal Sekolah :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_asal_sekolah" name="nama_asal_sekolah" placeholder="Masukkan Nama Asal Sekolah" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="kecamatan" class="col-md-2 col-form-label text-md-right">Kecamatan :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="kabupaten" class="col-md-2 col-form-label text-md-right">Kabupaten :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukkan Kabupaten" required>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="provinsi" class="col-md-2 col-form-label text-md-right">Provinsi :</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Masukkan Provinsi" required>
                        </div>
                    </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-right">Tambah</button>
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