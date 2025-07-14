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
                <form action="/proses_cari_pendaftaran" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama : </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama pendaftar" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir : </label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary float-right">Cari</button>
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

<script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
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
