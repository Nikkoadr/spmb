@extends('layouts.admin.main_admin')
@section('link')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endsection

@section('title', 'Data SPMB')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Databases</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Data Ukuran Baju</li>
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
                    <h3 class="card-title">Data Ukuran Seragam</h3>
                    <a href="{{ url('/data_ukuran_seragam/download') }}" class="btn btn-info float-right m-1">
                        <i class="fa-solid fa-download"></i> Download
                    </a>
                </div>
                <div class="card-body">
                    <table id="tabel_ukuran_seragam" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>No Pendaftaran</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Asal Sekolah</th>
                                <th>Ukuran Baju</th>
                                <th>Panjang Celana</th>
                                <th>Lingkar Pinggang</th>
                                <th>Ukuran Sepatu</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_ukuran_seragam as $seragam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $seragam->no_pendaftaran }}</td>
                                <td>{{ $seragam->nama }}</td>
                                <td>{{ $seragam->jenis_kelamin->nama_jenis_kelamin ?? '-' }}</td>
                                <td>{{ $seragam->asal_sekolah->nama_asal_sekolah ?? '-' }}</td>
                                <td>{{ $seragam->ukuran_seragam_siswa_baru->ukuran_baju ?? '-' }}</td>
                                <td>{{ $seragam->ukuran_seragam_siswa_baru->ukuran_panjang_celana ?? '-' }}</td>
                                <td>{{ $seragam->ukuran_seragam_siswa_baru->ukuran_lingkar_pinggang_celana ?? '-' }}</td>
                                <td>{{ $seragam->ukuran_seragam_siswa_baru->ukuran_sepatu ?? '-' }}</td>
                                <td>
                                    @if($seragam->ukuran_seragam_siswa_baru)
                                        <a href="{{ url('/databases/edit_ukuran_seragam/'.$seragam->ukuran_seragam_siswa_baru->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $seragam->ukuran_seragam_siswa_baru->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @else
                                        <a href="{{ url('/databases/form_tambah_ukuran_seragam/'.$seragam->no_pendaftaran) }}" class="btn btn-info btn-sm">
                                            <i class="fa-solid fa-shirt"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
$(function () {
    $("#tabel_ukuran_seragam").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "pageLength": 50,
        "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tabel_ukuran_seragam_wrapper .col-md-6:eq(0)');
});
</script>

<script>
@if (session()->has('success'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 5000
    });
@endif

function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data tidak dapat dikembalikan setelah dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/databases/hapus_ukuran_seragam/${id}`;
        }
    });
}
</script>
@endsection
