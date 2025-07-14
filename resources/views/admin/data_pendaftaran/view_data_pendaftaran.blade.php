@extends('layouts.admin.main_admin')
@section('link')
<!-- DataTables -->
<link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection
@section('title')
    {{'Data SPMB'}}
@endsection
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data PPDB</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Data SPMB</li>
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
            <h3 class="card-title">Data Peserta Didik Baru</h3>
            <a href="/data_pendaftaran/tambah" class="btn btn-primary float-right m-1"><i class="fa-solid fa-user-plus"></i> Tambah Baru</a>
            <a href="/data_pendaftaran/download" class="btn btn-info float-right m-1"><i class="fa-solid fa-download"></i> Download</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="tabel_pendaftaran" class="table table-bordered table-striped">
                <thead>
                <tr style="text-align: center">
                <th>No</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>TTL</th>
                <th>Asal Sekolah</th>
                <th>Kontak</th>
                <th>Konsentrasi Keahlian</th>
                <th>Status</th>
                <th data-orderable="false">Menu</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftaran as $pendaftar)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pendaftar->nisn }}</td>
                        <td>{{ $pendaftar->nama }}</td>
                        <td>{{ $pendaftar->nama_jenis_kelamin }}</td>
                        <td>{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar -> tanggal_lahir)->translatedFormat('d F Y') }}</td>
                        <td>{{ $pendaftar->nama_asal_sekolah }}</td>    
                        <td>
                            <a href="https://wa.me/62{{ $pendaftar->no_siswa }}?text={{ urlencode('Assalamu’alaikum warahmatullahi wabarakatuh. Halo, ' . $pendaftar->nama . ' dari ' . $pendaftar->nama_asal_sekolah . '. Apakah betul Anda ingin melanjutkan ke SMK Muhammadiyah Kandanghaur ?. Jika ya tolong jawab whatsapp ini dengan YA') }}" target="_blank">
                                {{ $pendaftar->no_siswa }}
                            </a>
                        </td>
                        <td>{{ $pendaftar->nama_konsentrasi_keahlian }}</td>
                        <td>
                            @switch($pendaftar->id_status_siswa)
                                @case(1)
                                    <span class="badge badge-danger">{{ $pendaftar->nama_status_siswa }}</span>
                                    @break
                                @case(2)
                                    <span class="badge badge-warning">{{ $pendaftar->nama_status_siswa }}</span>
                                    @break
                                @case(3)
                                    <span class="badge badge-info">{{ $pendaftar->nama_status_siswa }}</span>
                                    @break
                                @case(4)
                                    <span class="badge badge-primary">{{ $pendaftar->nama_status_siswa }}</span>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <a href="/data_pendaftaran/edit/{{ $pendaftar->id }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="/data_pendaftaran/cetak/{{ $pendaftar->id }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa-solid fa-print"></i></a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $pendaftar->id }})"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
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
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script>
$(function () {
$("#tabel_pendaftaran").DataTable({
    "responsive": true, 
    "lengthChange": true, 
    "autoWidth": true, 
    "pageLength": 50,
    "aLengthMenu": [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
}).buttons().container().appendTo('#tabel_pendaftaran_wrapper .col-md-6:eq(0)');
});
</script>
<script>
    @if (session()->has('success'))
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
        Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}'
        })
    @endif
</script>
<script>
    function confirmDelete(roleId) {
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
                window.location.href = `/data_pendaftaran/hapus/${roleId}`;
            }
        });
    }
</script>
@endsection