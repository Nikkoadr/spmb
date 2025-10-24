<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>PPDB SMK Muhammadiyah Kandanghaur</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/home/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/home/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/home/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/home/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
        <div>
                <img  class="img-fluid position-absolute top-0 start-0 w-100 h-100 d-flex" src="{{ asset('assets/home/img/carousel-1.png') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3">Sistem Penerimaan Murid Baru ( SPMB )</h5>
                                <h1 class="display-3 text-white">SMK Muhammadiyah Kandanghaur</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Bergerak Maju Menjadi Yang Terdepan</p>
                                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                        <a href="/cari_pendaftaran" class="btn btn-primary btn-custom py-md-3 px-md-5">Sudah Daftar</a>
                                        <a href="/form_pendaftaran" class="btn btn-light btn-custom py-md-3 px-md-5">Daftar Baru</a>
                                        {{-- <a href="/tes_minat_bakat" class="btn btn-success btn-custom py-md-3 px-md-5">Tes Minat Bakat</a> --}}
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <!-- Carousel End -->
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/home/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/home/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('assets/home/js/main.js') }}"></script>
    
</body>
</html>