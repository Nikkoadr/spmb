@php
    use Illuminate\Support\Carbon;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak SPMB | SMK Muhammadiyah Kandanghaur</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/icon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/cetak.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    /* Ukuran dan pengaturan cetak */
    @page {
        size: A4;
        margin: 1.2cm;
    }

    body {
        font-family: 'Nunito', sans-serif;
        background: #f7fafc;
        color: #2d2d2d;
        margin: 0;
        padding: 0;
    }

    .page {
        background: #ffffff;
        padding: 25px 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        max-width: 210mm;
        min-height: 297mm;
        margin: auto;
    }

    /* HEADER */
    .header-text b {
        color: #0077b6;
        display: block;
        line-height: 1.4;
    }

    .divider {
        height: 5px;
        border-bottom: 3px solid #0077b6;
        border-top: 1px solid #e0e0e0;
        margin: 10px 0 15px 0;
    }

    /* JUDUL */
    b[style*="font-size:20pt;"] {
        color: #023e8a;
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    /* SECTION TITLE */
    .section-title {
        background: #90e0ef;
        color: #023e8a;
        font-weight: 700;
        padding: 7px 10px;
        border-radius: 6px;
        text-transform: uppercase;
        font-size: 11pt !important;
    }

    /* TABLE GRID */
    .it-grid {
        width: 100%;
        border-collapse: collapse;
        margin-top: 6px;
        border: 1px solid #ddd;
        font-size: 10pt;
    }

    .it-grid td {
        border: 1px solid #e0e0e0;
        padding: 5px 8px;
        vertical-align: top;
    }

    .it-grid td:first-child {
        background: #e8f8ff;
        font-weight: 600;
        color: #023e8a;
        width: 230px;
    }

    .it-grid tr:nth-child(even) td {
        background: #f9fdff;
    }

    /* NOTE BOX */
    .note-box {
        border: 2px dashed #00b4d8;
        background: #e3f8ff;
        width: 250px;
        padding: 10px;
        font-size: 9.5pt;
        border-radius: 6px;
        color: #023e8a;
    }

    /* FOOTER SOCIAL */
    .footer-social {
        font-size: 9pt;
        color: #333;
        border-top: 1px solid #e0e0e0;
        padding-top: 8px;
        margin-top: 20px;
    }

    .footer-social td {
        vertical-align: middle;
        padding: 3px 5px;
    }

    .footer-social img {
        width: 22px;
        vertical-align: middle;
    }

    /* LINK */
    a {
        color: #0077b6;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* CETAK */
    @media print {
        body {
            background: #fff;
        }
        .page {
            box-shadow: none;
            border-radius: 0;
            margin: 0;
            padding: 0;
        }
        .note-box {
            border: 1px solid #000;
            background: none;
        }
    }
</style>

</head>
<body>
<div class="page">

    {{-- Header --}}
    <table width="100%">
        <tr>
            <td width="100px" align="center">
                <img src="{{ asset('assets/img/dikdasmenmuh.png') }}" width="100%">
            </td>
            <td align="center" class="header-text">
                <b style="font-size:14px;">MAJELIS PENDIDIKAN DASAR DAN MENENGAH DAN PENDIDIKAN NONFORMAL</b>
                <b style="font-size:14px;">PIMPINAN WILAYAH MUHAMMADIYAH JAWA BARAT</b>
                <b style="font-size:20px;">SMK MUHAMMADIYAH KANDANGHAUR</b>
                <b style="font-size:20px;">SMK PUSAT KEUNGGULAN (PK)</b>
                <b>Terakreditasi "A" (Unggul)</b>
                <b>Nomor : 18572022/BAN-SM/SK/2022</b>
            </td>
            <td width="100px" align="center">
                <img src="{{ asset('assets/img/logo.png') }}" width="80%">
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <small>Konsentrasi Keahlian: TKR, TSM, TPL, TEI, TKJ, FKK</small><br>
                <small>Jl. Raya Karanganyar No. 28/A Kec. Kandanghaur Kab. Indramayu 45254 Telp. (0234) 507239</small><br>
                <small>Email: smkmuhkandanghaur@gmail.com | Web: www.smkmuhkandanghaur.sch.id</small>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    {{-- Judul --}}
    <div style="text-align:center; margin:20px auto 30px;">
        <b style="font-size:20pt;">FORMULIR PENDAFTARAN ONLINE PESERTA DIDIK BARU</b><br>
        <b style="font-size:20pt;">{{ $pendaftaran->periode->tahun_ajaran ?? '-' }}</b>
    </div>

    {{-- ID --}}
    <div style="margin:15px 0;">
        <b style="font-size:14pt;">ID Pendaftaran : {{ $pendaftaran->no_pendaftaran }}</b>
    </div>

    {{-- Identitas --}}
    <table width="100%" class="it-grid">
        <tr><td colspan="2" align="center" class="section-title">IDENTITAS PESERTA DIDIK BARU</td></tr>
        <tr><td width="250px">Daftar Pada Tanggal</td><td>{{ Carbon::parse($pendaftaran->created_at)->translatedFormat('d F Y') }}</td></tr>
        <tr><td>NISN</td><td>{{ $pendaftaran->nisn ?? '-' }}</td></tr>
        <tr><td>No. KK</td><td>{{ $pendaftaran->no_kk ?? '-' }}</td></tr>
        <tr><td>No. NIK</td><td>{{ $pendaftaran->no_nik ?? '-' }}</td></tr>
        <tr><td>Nama Lengkap</td><td>{{ $pendaftaran->nama }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>{{ $pendaftaran->jenis_kelamin->nama_jenis_kelamin ?? '-' }}</td></tr>
        <tr><td>Tempat, Tanggal Lahir</td>
            <td>{{ $pendaftaran->tempat_lahir }}, {{ Carbon::parse($pendaftaran->tanggal_lahir)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr><td>Asal Sekolah</td><td>{{ $pendaftaran->asal_sekolah->nama_asal_sekolah ?? '-' }}</td></tr>
        <tr><td>NIK Ayah</td><td>{{ $pendaftaran->nik_ayah ?? '-' }}</td></tr>
        <tr><td>Nama Ayah</td><td>{{ $pendaftaran->nama_ayah ?? '-' }}</td></tr>
        <tr><td>Pekerjaan Ayah</td><td>{{ $pendaftaran->pekerjaan_ayah ?? '-' }}</td></tr>
        <tr><td>NIK Ibu</td><td>{{ $pendaftaran->nik_ibu ?? '-' }}</td></tr>
        <tr><td>Nama Ibu</td><td>{{ $pendaftaran->nama_ibu ?? '-' }}</td></tr>
        <tr><td>Pekerjaan Ibu</td><td>{{ $pendaftaran->pekerjaan_ibu ?? '-' }}</td></tr>
        <tr><td>Status Orang Tua</td><td>{{ $pendaftaran->status_orang_tua->nama_status_orang_tua ?? '-' }}</td></tr>
        <tr>
            <td>Alamat</td>
            <td>
                BLOK {{ $pendaftaran->blok ?? '-' }} - RT {{ $pendaftaran->rt ?? '-' }} - RW {{ $pendaftaran->rw ?? '-' }}<br>
                DESA {{ $pendaftaran->desa ?? '-' }} - KEC. {{ $pendaftaran->kecamatan ?? '-' }} - KAB. {{ $pendaftaran->kabupaten ?? '-' }}
            </td>
        </tr>
        <tr><td>No. HP Siswa</td><td>{{ $pendaftaran->no_siswa ?? '-' }}</td></tr>
        <tr><td>No. HP Orang Tua</td><td>{{ $pendaftaran->no_wali_siswa ?? '-' }}</td></tr>
        <tr><td>Jurusan Yang Diminati</td><td>{{ $pendaftaran->konsentrasi_keahlian->nama_konsentrasi_keahlian ?? '-' }}</td></tr>
        <tr><td>Referensi</td><td>{{ $pendaftaran->referensi ?? '-' }}</td></tr>
    </table>

    {{-- Catatan & QR --}}
    <table width="100%" style="margin:20px auto;">
        <tr>
            <td width="50%">
                <div class="note-box">
                    <b>Catatan :</b><br>
                    Harap simpan bukti Pendaftaran Online ini.<br><br>
                    <b>Contact Person PPDB:</b><br>
                    Customer Service SMK : 0812-2207-770
                </div>
            </td>
            <td align="center">
                <p>Indramayu, {{ Carbon::parse($pendaftaran->created_at)->translatedFormat('d F Y') }}</p>
                {!! QrCode::size(70)->backgroundColor(255,255,255)->generate(env('APP_URL').'/scan/'.$pendaftaran->no_pendaftaran) !!}
                <br><br>
                <p>Panitia SPMB</p>
            </td>
        </tr>
    </table>

    {{-- Footer Social Media --}}
    <table width="100%" class="footer-social" style="margin-top:40px;">
        <tr>
            <td><img src="https://logodownload.org/wp-content/uploads/2017/04/instagram-logo.png"></td><td>@smkmuhkandanghaur</td>
            <td><img src="https://logodownload.org/wp-content/uploads/2023/07/threads-logo-0.png"></td><td>@smkmuhkandanghaur</td>
            <td><img src="https://logodownload.org/wp-content/uploads/2014/09/facebook-logo-1-2.png"></td><td>smkmuhkandanghaur</td>
            <td><img src="https://logodownload.org/wp-content/uploads/2014/10/youtube-logo-5-2.png"></td><td>smkmuhkandanghaur</td>
            <td><img src="https://logodownload.org/wp-content/uploads/2019/08/tiktok-logo-0-1.png"></td><td>@smkmuhkandanghaur</td>
        </tr>
    </table>
</div>

{{-- JS --}}
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
$(document).ready(function() {
    const whatsappLink = "https://chat.whatsapp.com/GjidVJtwEbC7pjcxonfioV";
    const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(whatsappLink)}`;

    Swal.fire({
        title: "Pendaftaran Berhasil!",
        icon: "success",
        html: `
            <p>Bergabunglah dengan grup WhatsApp Calon Siswa SMK Muhammadiyah Kandanghaur:</p>
            <a href="${whatsappLink}" target="_blank">${whatsappLink}</a>
            <br><br>
            <p>Barcode WhatsApp Grup :</p>
            <img src="${qrCodeUrl}" alt="QR Code WhatsApp" width="150" height="150"/>
            <br><p>Tekan OK untuk mencetak bukti pendaftaran atau simpan bukti pendaftaran ini.</p>
        `
    }).then((result) => {
        if (result.isConfirmed) {
            setTimeout(() => window.print(), 500);
        }
    });
});
</script>
</body>
</html>
