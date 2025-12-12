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

                            <form action="{{route('data_ukuran_seragam.store', $data->id)}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $data->nama }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ukuran_baju" class="col-sm-2 col-form-label">Ukuran Baju :</label>
                                    <div class="col-sm-10">
                                        <select name="ukuran_baju" id="ukuran_baju" class="form-control" required>
                                            <option value="">Pilih Ukuran</option>
                                            <option value="M" {{ old('ukuran_baju') == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="L" {{ old('ukuran_baju') == 'L' ? 'selected' : '' }}>L</option>
                                            <option value="XL" {{ old('ukuran_baju') == 'XL' ? 'selected' : '' }}>XL</option>
                                            <option value="XXL" {{ old('ukuran_baju') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            <option value="XXXL" {{ old('ukuran_baju') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                                            <option value="XXXXL" {{ old('ukuran_baju') == 'XXXXL' ? 'selected' : '' }}>XXXXL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ukuran_panjang_celana" class="col-sm-2 col-form-label">Panjang Celana :</label>
                                    <div class="col-sm-10">
                                        <select name="ukuran_celana" id="ukuran_celana" class="form-control" required>
                                            <option value="">Pilih Ukuran</option>
                                            <option value="M" {{ old('ukuran_celana') == 'M' ? 'selected' : '' }}>M</option>
                                            <option value="L" {{ old('ukuran_celana') == 'L' ? 'selected' : '' }}>L</option>
                                            <option value="XL" {{ old('ukuran_celana') == 'XL' ? 'selected' : '' }}>XL</option>
                                            <option value="XXL" {{ old('ukuran_celana') == 'XXL' ? 'selected' : '' }}>XXL</option>
                                            <option value="XXXL" {{ old('ukuran_celana') == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                                            <option value="XXXXL" {{ old('ukuran_celana') == 'XXXXL' ? 'selected' : '' }}>XXXXL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ukuran_sepatu" class="col-sm-2 col-form-label">Ukuran Sepatu :</label>
                                    <div class="col-sm-10">
                                        <select name="ukuran_sepatu" id="ukuran_sepatu" class="form-control" required>
                                            <option value="">Pilih Ukuran</option>
                                            <option value="37" {{ old('ukuran_sepatu') == '37' ? 'selected' : '' }}>37</option>
                                            <option value="38" {{ old('ukuran_sepatu') == '38' ? 'selected' : '' }}>38</option>
                                            <option value="39" {{ old('ukuran_sepatu') == '39' ? 'selected' : '' }}>39</option>
                                            <option value="40" {{ old('ukuran_sepatu') == '40' ? 'selected' : '' }}>40</option>
                                            <option value="41" {{ old('ukuran_sepatu') == '41' ? 'selected' : '' }}>41</option>
                                            <option value="42" {{ old('ukuran_sepatu') == '42' ? 'selected' : '' }}>42</option>
                                            <option value="43" {{ old('ukuran_sepatu') == '43' ? 'selected' : '' }}>43</option>
                                            <option value="44" {{ old('ukuran_sepatu') == '44' ? 'selected' : '' }}>44</option>
                                            <option value="45" {{ old('ukuran_sepatu') == '45' ? 'selected' : '' }}>45</option>
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
