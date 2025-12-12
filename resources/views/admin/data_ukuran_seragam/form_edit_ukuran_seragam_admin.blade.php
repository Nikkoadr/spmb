@extends('layouts.admin.main_admin')
@section('link')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection
@section('title', 'Form Edit Ukuran Seragam')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data SPMB</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item">Databases</li>
                        <li class="breadcrumb-item">Ukuran Seragam</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Ukuran Seragam</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('data_ukuran_seragam.update', $data_ukuran_seragam->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama siswa dari relasi Pendaftaran --}}
                        <div class="form-group row">
                            <label for="nama" class="col-md-2 col-form-label text-md-right">Nama Siswa :</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" 
                                    value="{{ $data_ukuran_seragam->pendaftaran->nama }}" readonly>
                            </div>
                        </div>

                        {{-- Ukuran Baju --}}
                        <div class="form-group row">
                            <label for="ukuran_baju" class="col-md-2 col-form-label text-md-right">Ukuran Baju :</label>
                            <div class="col-md-10">
                                <select class="form-control" name="ukuran_baju" id="ukuran_baju" required>
                                    <option value="{{ $data_ukuran_seragam->ukuran_baju }}" selected>
                                        {{ $data_ukuran_seragam->ukuran_baju }}
                                    </option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                    <option value="XXXL">XXXL</option>
                                    <option value="XXXXL">XXXXL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ukuran_celana" class="col-md-2 col-form-label text-md-right">Ukuran Celana :</label>
                            <div class="col-md-10">
                                <select class="form-control" name="ukuran_celana" id="ukuran_celana" required>
                                    <option value="{{ $data_ukuran_seragam->ukuran_celana }}" selected>
                                        {{ $data_ukuran_seragam->ukuran_celana }}
                                    </option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                    <option value="XXXL">XXXL</option>
                                    <option value="XXXXL">XXXXL</option>
                                </select>
                            </div>
                        </div>

                        {{-- Ukuran Sepatu --}}
                        <div class="form-group row">
                            <label for="ukuran_sepatu" class="col-md-2 col-form-label text-md-right">Ukuran Sepatu:</label>
                            <div class="col-md-10">
                                <select class="form-control" name="ukuran_sepatu" id="ukuran_sepatu" required>
                                    <option value="{{ $data_ukuran_seragam->ukuran_sepatu }}" selected>
                                        {{ $data_ukuran_seragam->ukuran_sepatu }}
                                    </option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                </select>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
    @if (session()->has('success'))
        Swal.fire({ title: "Sukses!", text: "{{ session('success') }}", icon: "success" });
    @elseif (session()->has('error'))
        Swal.fire({ title: "Maaf!", text: "{{ session('error') }}", icon: "error" });
    @endif
</script>
@endsection
