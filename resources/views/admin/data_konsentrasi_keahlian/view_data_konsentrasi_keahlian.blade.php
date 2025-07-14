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
        <h1 class="m-0">Databases</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item">Databases</li>
            <li class="breadcrumb-item active">Periode</li>
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
            <h3 class="card-title">Data Periode</h3>
            <a href="/databases/form_tambah_konsentrasi_keahlian" class="btn btn-primary float-right">Tambah</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="tabel_pendaftaran" class="table table-bordered table-striped">
                <thead>
                <tr style="text-align: center">
                <th>No</th>
                <th>Nama Konsentrasi Keahlian</th>
                <th data-orderable="false">Menu</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data_konsentrasi_keahlian as $kk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kk->nama_konsentrasi_keahlian }}</td>
                        <td>
                            <a href="/databases/edit_konsentrasi_keahlian/{{ $kk->id }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $kk->id }})"><i class="fa-solid fa-trash"></i></button>
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
                window.location.href = `/databases/hapus_konsentrasi_keahlian/${roleId}`;
            }
        });
    }
</script>
@endsection