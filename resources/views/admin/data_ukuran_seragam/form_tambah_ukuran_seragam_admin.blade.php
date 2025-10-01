@extends('layouts.admin.main_admin')

@section('link')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('title', 'Form Tambah Ukuran Seragam')

@section('content')
<div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Ukuran Seragam</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item">Databases</li>
                        <li class="breadcrumb-item">Ukuran Seragam</li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Ukuran Seragam</h3>
                        </div>
                        <div class="card-body">

                            <form action="{{ url('/proses_isi_ukuran_seragam/' . $data->id) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $data->nama }}" readonly>
                                    </div>
                                </div>

                                <!-- Ukuran Baju -->
                                <img width="1000" src="{{ asset('assets/img/ukuran/ukuran_baju.png') }}" alt="Ukuran Baju">
                                <div class="form-group row">
                                    <label for="ukuran_baju" class="col-sm-2 col-form-label">Ukuran Baju :</label>
                                    <div class="col-sm-10">
                                        <select name="ukuran_baju" id="ukuran_baju" class="form-control" required>
                                            <option value="">Pilih Ukuran</option>
                                            @foreach (['M','L','XL','XXL','JUMBO'] as $baju)
                                                <option value="{{ $baju }}" {{ old('ukuran_baju') == $baju ? 'selected' : '' }}>
                                                    {{ $baju == 'JUMBO' ? 'JUMBO (Ukur Ulang)' : $baju }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Ukuran Celana -->
                                <img width="1000" src="{{ asset('assets/img/ukuran/ukuran_celana.png') }}" alt="Ukuran Celana">
                                <div class="form-group row">
                                    <label for="ukuran_panjang_celana" class="col-sm-2 col-form-label">Panjang Celana :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ukuran_panjang_celana"
                                            name="ukuran_panjang_celana" value="{{ old('ukuran_panjang_celana') }}"
                                            placeholder="Ukuran Panjang Celana" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ukuran_lingkar_pinggang_celana" class="col-sm-2 col-form-label">Lingkar Pinggang :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ukuran_lingkar_pinggang_celana"
                                            name="ukuran_lingkar_pinggang_celana"
                                            value="{{ old('ukuran_lingkar_pinggang_celana') }}"
                                            placeholder="Ukuran Lingkar Pinggang Celana" required>
                                    </div>
                                </div>

                                <!-- Ukuran Sepatu -->
                                <img width="700" src="{{ asset('assets/img/ukuran/ukuran_sepatu.webp') }}" alt="Ukuran Sepatu">
                                <div class="form-group row">
                                    <label for="ukuran_sepatu" class="col-sm-2 col-form-label">Ukuran Sepatu :</label>
                                    <div class="col-sm-10">
                                        <select name="ukuran_sepatu" id="ukuran_sepatu" class="form-control" required>
                                            <option value="">Pilih Ukuran</option>
                                            @foreach (range(37,44) as $sepatu)
                                                <option value="{{ $sepatu }}" {{ old('ukuran_sepatu') == $sepatu ? 'selected' : '' }}>
                                                    {{ $sepatu }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary float-right">Simpan</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    @if (session()->has('success'))
        Swal.fire("Sukses!", "{{ session('success') }}", "success");
    @elseif (session()->has('error'))
        Swal.fire("Maaf!", "{{ session('error') }}", "error");
    @endif
</script>
@endsection
