<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | Smkmuhkandanghaur</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

@yield('link')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@yield('preloader')

@include('layouts.admin.partials.navbar')

@include('layouts.admin.partials.aside')

@yield('content')
  <footer class="main-footer">
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.1.2
  </div>
    <strong>Copyright &copy; 2023-2026 <a href="#">Nikko Adrian</a>.</strong> All rights reserved.
  </footer>
</div>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

@yield('script')

</body>
</html>
