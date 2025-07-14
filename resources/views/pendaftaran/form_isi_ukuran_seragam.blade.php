<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SPMB SMK Muhammadiyah Kandanghaur</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
<div class="container">
    <a href="/" class="navbar-brand">
    <img src="{{ asset('assets/img/logo.png') }}" alt="smkmuhkandanghaur" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Smkmuhkandanghaur</span>
    </a>
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
    <ul class="navbar-nav">
        <li class="nav-item">
        <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
        <a href="https://wa.me/6281122207770" class="nav-link">Kontak</a>
        </li>
    </ul>
    </div>
</div>
</nav>
<div class="content-wrapper">
<div class="content-header">
    <div class="container">
    <div class="row mb-2">
        <div class="col-sm-12">
        <h1 class="m-0 text-center"> Cari Calon Peserta Didik Baru <small></small></h1>
        </div>
    </div>
    </div>
</div>
<div class="content">
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-white p-4 shadow-sm">
                <form action="/proses_isi_ukuran_seragam_{{$pendaftaran->id}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pendaftaran->nama }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asal_sekolah" class="col-sm-2 col-form-label">Asal Sekolah : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ $pendaftaran->nama_asal_sekolah }}" readonly>
                        </div>
                    </div>
                    <img width="1000" src="{{ asset('assets/img/ukuran/ukuran_baju.png') }}" alt="">
                    <div class="form-group row">
                        <label for="ukuran_baju" class="col-sm-2 col-form-label">Ukuran baju : </label>
                        <div class="col-sm-10">
                            <select name="ukuran_baju" id="ukuran_baju" class="form-control">
                                <option value="">Pilih Ukuran</option>
                                <option value="M">M</option>
                                <option value="L">L</option>    
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                                <option value="JUMBO">JUMBO (Ukur Ulang)</option>
                            </select>
                        </div>
                    </div>
                    <img width="1000" src="{{ asset('assets/img/ukuran/ukuran_celana.png') }}" alt="">
                    {{-- <div class="form-group row">
                        <label for="ukuran_celana" class="col-sm-2 col-form-label">Ukuran Celana : </label>
                        <div class="col-sm-10">
                            <select name="ukuran_celana" id="ukuran_celana" class="form-control">
                                <option value="">Pilih Ukuran</option>
                                <option value="">Pilih Ukuran</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                                <option value="XXXL">XXXL (Ukur Ulang)</option>
                                <option value="JUMBO">JUMBO (Ukur Ulang)</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="ukuran_panjang_celana" class="col-sm-2 col-form-label">Ukuran Celana Panjang: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ukuran_panjang_celana" name="ukuran_panjang_celana" placeholder="Ukuran Panjang Celana" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ukuran_lingkar_pinggang_celana" class="col-sm-2 col-form-label">Ukuran Lingkar Pinggang Celana: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ukuran_lingkar_pinggang_celana" name="ukuran_lingkar_pinggang_celana" placeholder="Ukuran Lingkar Pinggang Celana" required>
                        </div>
                    </div>
                    <img src="{{ asset('assets/img/ukuran/ukuran_sepatu.webp') }}" alt="">
                    <div class="form-group row">
                        <label for="ukuran_sepatu" class="col-sm-2 col-form-label">Ukuran Celana : </label>
                        <div class="col-sm-10">
                            <select name="ukuran_sepatu" id="ukuran_sepatu" class="form-control">
                                <option value="">Pilih Ukuran</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary float-right">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<footer class="main-footer">
<div class="float-right d-none d-sm-inline">
    Anything you want
</div>

<strong>Copyright &copy; 2014-2026 <a href="https://adminlte.io">Nikko Adrian</a>.</strong> All rights reserved.
</footer>
</div>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/plugins/adminlte.min.js') }}"></script>

<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
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
</body>
</html>
