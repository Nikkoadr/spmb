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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data PPDB</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Data SPMB</li>
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
                            <h3 class="card-title">Data Peserta Didik Baru</h3>
                            <div class="card-tools">
                                <a href="{{ url('/data_pendaftaran/tambah') }}" class="btn btn-primary btn-sm m-1">
                                    <i class="fa-solid fa-user-plus"></i> Tambah Baru
                                </a>
                                <a href="{{ url('/data_pendaftaran/download') }}" class="btn btn-info btn-sm m-1">
                                    <i class="fa-solid fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="tabel_pendaftaran" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>TTL</th>
                                        <th>Asal Sekolah</th>
                                        <th>Kontak</th>
                                        <th>Konsentrasi Keahlian</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th data-orderable="false">Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendaftaran as $pendaftar)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pendaftar->nisn }}</td>
                                            <td>{{ $pendaftar->nama }}</td>
                                            <td>{{ $pendaftar->jenis_kelamin->nama_jenis_kelamin ?? '-' }}</td>
                                            <td>{{ $pendaftar->tempat_lahir }},
                                                {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ $pendaftar->asal_sekolah->nama_asal_sekolah ?? '-' }}</td>
                                            <td>
                                            @if ($pendaftar->no_siswa)
                                                <a href="https://wa.me/62{{ $pendaftar->no_siswa }}?text={{ urlencode(
                                            'Assalamu’alaikum warahmatullahi wabarakatuh.

                                            Dengan hormat,
                                            Kami mengundang calon siswa baru SMK Muhammadiyah Kandanghaur atas nama '
                                            . $pendaftar->nama .
                                            ' dari '
                                            . ($pendaftar->asal_sekolah->nama_asal_sekolah ?? '-')
                                            . ' untuk melakukan pendaftaran ulang sekaligus pengukuran seragam sekolah.

                                            Kegiatan ini dilaksanakan setiap hari Senin s/d Jumat,
                                            Pukul 08.00 s/d 15.30 WIB,
                                            bertempat di SMK Muhammadiyah Kandanghaur.

                                            Sehubungan dengan jumlah pendaftar yang telah mencapai 500 calon siswa, maka diadakan pendaftaran ulang sebagai bentuk konfirmasi dan keseriusan calon siswa dalam melanjutkan proses penerimaan di SMK Muhammadiyah Kandanghaur.

                                            Calon siswa diharapkan hadir sesuai jadwal dengan membawa uang DP sebesar Rp 500.000 sebagai pembayaran awal biaya seragam sekolah.

                                            Demikian undangan ini kami sampaikan.
                                            Atas perhatian dan kehadirannya kami ucapkan terima kasih.

                                            Wassalamu’alaikum warahmatullahi wabarakatuh.

                                            Panitia SMPB'
                                            ) }}"
                                                target="_blank">
                                                    {{ $pendaftar->no_siswa }}
                                                </a>
                                            @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $pendaftar->konsentrasi_keahlian->nama_konsentrasi_keahlian ?? '-' }}</td>
                                            <td>
                                                @switch($pendaftar->id_status_siswa)
                                                    @case(1)
                                                        <span class="badge badge-danger">{{ $pendaftar->status_siswa->nama_status_siswa }}</span>
                                                        @break
                                                    @case(2)
                                                        <span class="badge badge-warning">{{ $pendaftar->status_siswa->nama_status_siswa }}</span>
                                                        @break
                                                    @case(3)
                                                        <span class="badge badge-info">{{ $pendaftar->status_siswa->nama_status_siswa }}</span>
                                                        @break
                                                    @case(4)
                                                        <span class="badge badge-primary">{{ $pendaftar->status_siswa->nama_status_siswa }}</span>
                                                        @break
                                                    @default
                                                        <span class="badge badge-secondary">Tidak diketahui</span>
                                                @endswitch
                                            </td>
                                                <td>
                                                    @php $ukuran = $pendaftar->ukuran_seragam_siswa_baru; @endphp

                                                    <div>
                                                        <span>{!! $ukuran && $ukuran->ukuran_baju ? '✅' : '❌' !!} Baju</span><br>
                                                        <span>{!! $ukuran && ($ukuran->ukuran_celana || $ukuran->ukuran_panjang_celana || $ukuran->ukuran_lingkar_pinggang_celana) ? '✅' : '❌' !!} Celana</span><br>
                                                        <span>{!! $ukuran && $ukuran->ukuran_sepatu ? '✅' : '❌' !!} Sepatu</span>
                                                    </div>
                                                </td>
                                            <td>
                                                <a href="{{ url('/data_pendaftaran/edit/'.$pendaftar->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <a href="{{ url('/data_pendaftaran/cetak/'.$pendaftar->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $pendaftar->id }})">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
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
            </div>
        </div>
    </section>
    <!-- /.content -->
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
    $("#tabel_pendaftaran").DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 50,
        lengthMenu: [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, "All"]
        ],
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tabel_pendaftaran_wrapper .col-md-6:eq(0)');
});

// Notifikasi sukses
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

// Konfirmasi hapus
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
            window.location.href = `/data_pendaftaran/hapus/${id}`;
        }
    });
}
</script>
@endsection
