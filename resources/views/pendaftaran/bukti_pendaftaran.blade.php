@php
    use Illuminate\Support\Carbon; 
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/cetak.min.css') }}">
    <link rel="icon" type="image/x-icon" href="/images/icon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        ol > li {
            padding: 5px 10px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print SPMB SMK Muhammadiyah Kandanghaur</title>
</head>
<body>
    <div class="page">
        <table width="100%">
            <tr>
                <td width="100px" align="center" valign="middle">
                    <img src="{{ asset('assets/img/dikdasmenmuh.png') }}" width="100%">
                </td>
                <td align="center" valign="middle">
                    <b style="color:#007bff;font-size:14px !important;">MAJELIS PENDIDIKAN DASAR DAN MENENGAH DAN PENDIDIKAN NONFORMAL</b><br>
                    <b style="color:#007bff;font-size:14px !important;">PIMPINAN WILAYAH MUHAMMADIYAH JAWA BARAT</b><br>
                    <b style="color:#007bff;font-size:20px !important;">SMK MUHAMMADIYAH KANDANGHAUR</b><br>
                    <b style="color:#007bff;font-size:20px !important;">SMK PUSAT KEUNGGULAN (PK)</b><br>
                    <b>Terakreditasi "A" (Unggul)</b><br>
                    <b>Nomor : 18572022/BAN-SM/SK/2022</b>
                    <div style="height:20px"></div>
                </td>
                <td width="100px" align="center" valign="middle">
                    <img src="{{ asset('assets/img/logo.png') }}" width="80%">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <small style="font-size:10pt !important;">Konsentrasi Keahlian : Teknik Kendaraan Ringan (TKR), Teknik Sepeda Motor (TSM), Teknik Pengelasan (TPL),</small><br>
                    <small style="font-size:10pt !important;">Teknik Elektronika Industri (TEI), Teknik Komputer dan Jaringan (TKJ), Farmasi Klinis dan Komunitas (FKK)</small><br>
                    <small style="font-size:8pt !important;">Jl. Raya Karanganyar No. 28/A Kec. Kandanghaur Kab. Indramayu 45254 Telp. (0234) 507239,</small><br>
                    <small style="font-size:8pt !important;">email : smkmuhkandanghaur@gmail.com website : https://www.smkmuhkandanghaur.sch.id</small>
                </td>
            </tr>
        </table>
        
        <div style="height:5px; border-bottom:solid 2px black; border-top:solid 1px black; margin:10px 0"></div>
        
        <div style="text-align:center; margin:20px auto 30px auto">
            <b style="font-size:20pt !important;">FORMULIR PENDAFTARAN ONLINE PESERTA DIDIK BARU</b><br>
            <b style="font-size:20pt !important;">2025/2026</b>
        </div>
        
        <div style="text-align:left; margin:15px auto 20px auto">
            <b style="font-size:14pt !important;">ID Pendaftaran : {{ $pendaftaran->no_pendaftaran }}</b><br>
        </div>
        
        <table width="100%" class="it-grid">
            <tr style="background:#f6ff00">
                <td style="padding:10px" colspan="2" align="center"><b style="font-size:12pt !important;">IDENTITAS PESERTA DIDIK BARU</b></td>
            </tr>
            <tr><td width="250px">Daftar Pada tanggal</td><td>{{ \Carbon\Carbon::parse($pendaftaran->created_at)->translatedFormat('d F Y') }}</td></tr>
            <tr><td width="250px">Nomor Induk Siswa Nasional</td><td>{{ $pendaftaran->nisn }}</td></tr>
            <tr><td>Nomor Kartu Keluarga</td><td>{{ $pendaftaran->no_kk }}</td></tr>
            <tr><td>Nomor Kartu Tanda Penduduk</td><td>{{ $pendaftaran->no_nik }}</td></tr>
            <tr><td>Nama Lengkap Calon Peserta Didik</td><td>{{ $pendaftaran->nama }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>{{ $pendaftaran->nama_jenis_kelamin }}</td></tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>{{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Asal Sekolah</td><td>{{ $pendaftaran->nama_asal_sekolah }}</td></tr>
            <tr><td>Nama Ayah</td><td>{{ $pendaftaran->nama_ayah }}</td></tr>
            <tr><td>Pekerjaan Ayah</td><td>{{ $pendaftaran->pekerjaan_ayah }}</td></tr>
            <tr><td>Nama Ibu</td><td>{{ $pendaftaran->nama_ibu }}</td></tr>
            <tr><td>Pekerjaan Ibu</td><td>{{ $pendaftaran->pekerjaan_ibu }}</td></tr>
            <tr><td>Status Orang Tua</td><td>{{ $pendaftaran->nama_status_orang_tua }}</td></tr>
            <tr>
                <td>Alamat</td>
                <td>BLOK {{ $pendaftaran->blok }} - RT {{ $pendaftaran->rt }} - RW {{ $pendaftaran->rw }}<br>
                    DESA {{ $pendaftaran->desa }} - KECAMATAN {{ $pendaftaran->kecamatan }} - KABUPATEN {{ $pendaftaran->kabupaten }}
                </td>
            </tr>
            <tr><td>Nomor HP Siswa</td><td>{{ $pendaftaran->no_siswa }}</td></tr>
            <tr><td>Nomor HP Orang Tua</td><td>{{ $pendaftaran->no_wali_siswa }}</td></tr>
            <tr><td>Jurusan Yang Diminati</td><td>{{ $pendaftaran->nama_konsentrasi_keahlian }}</td></tr>
            <tr><td>Referensi</td><td>{{ $pendaftaran->referensi }}</td></tr>
        </table>
        
        <table width="100%" style="margin:20px auto">
            <tr>
                <td width="50%">
                    <div style="border:solid 1px black; width:250px; padding:10px">
                        <b>Catatan :</b><br>
                        Harap disimpan dengan baik bukti Pendaftaran Online ini.<br><br>
                        <b>Contact Person PPDB:</b><br>
                        Customer Services SMK : 08122207770
                    </div>
                </td>
                {{-- <td align="center">
                    <p>Barcode Pengisian Ukuran Seragam</p>
                    <br>
                    {!! QrCode::size(70)->backgroundColor(255,255,255)->generate(env('APP_URL').'/isi_ukuran_seragam/'.$pendaftaran->no_pendaftaran) !!}
                    <br>
                    <br>
                    <br>
                </td> --}}
                <td align="center">
                    <p>Indramayu, {{ \Carbon\Carbon::parse($pendaftaran->created_at)->translatedFormat('d F Y') }}</p>
                    <br>
                    {!! QrCode::size(70)->backgroundColor(255,255,255)->generate(env('APP_URL').'/scan/'.$pendaftaran->no_pendaftaran) !!}
                    <br>
                    <br>
                    <p>Panitia SPMB</p>
                </td>
            </tr>
        </table>
        
        <table width="100%" style="margin-top:40px">
            <tr>
                <td><img src="https://logodownload.org/wp-content/uploads/2017/04/instagram-logo.png" width="30px"></td>
                <td>@smkmuhkandanghaur</td>
                <td><img src="https://logodownload.org/wp-content/uploads/2023/07/threads-logo-0.png" width="30px"></td>
                <td>@smkmuhkandanghaur</td>
                <td><img src="https://logodownload.org/wp-content/uploads/2014/09/facebook-logo-1-2.png" width="30px"></td>
                <td>smkmuhkandanghaur</td>
                <td><img src="https://logodownload.org/wp-content/uploads/2014/10/youtube-logo-5-2.png" width="30px"></td>
                <td>smkmuhkandanghaur</td>
                <td><img src="https://logodownload.org/wp-content/uploads/2019/08/tiktok-logo-0-1.png" width="30px"></td>
                <td>@smkmuhkandanghaur</td>
            </tr>
        </table>
    </div>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
$(document).ready(function() {
    const whatsappLink = "https://chat.whatsapp.com/JVnWE8SKkfr2v1BDfVuCAD";
    const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(whatsappLink)}`;
    Swal.fire({
        title: "Pendaftaran Berhasil!",
        icon: "success",
        html: `
            <p>Bergabunglah dengan grup WhatsApp Calon Siswa SMK Muhammadiyah Kandanghaur:</p>
            <a href="${whatsappLink}" target="_blank">${whatsappLink}</a>
            <br><br>
            <p>Bracode WhatsApp Grup :</p>
            <img src="${qrCodeUrl}" alt="QR Code WhatsApp" style="width: 150px; height: 150px;"/>
            <br>
            <p>Tekan Ok untuk mencetak bukti pendaftaran</p>
            <br>
        `
    }).then((result) => {
        if (result.isConfirmed) {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    });
});
</script>
</body>
</html>
