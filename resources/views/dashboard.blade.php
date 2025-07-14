@extends('layouts.admin.main_admin')
@section('title')
  {{'Dashboard SPMB'}}
@endsection
@section('link')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @foreach($jurusan as $j)
            @php
              switch($j->nama_konsentrasi_keahlian){
                case 'Teknik Pengelasan':
                  $color = 'bg-danger';
                  $icon = 'ion-nuclear';
                  break;
                case 'Teknik Elektronika Industri':
                  $color = 'bg-warning';
                  $icon = 'ion-ios-lightbulb';
                  break;
                case 'Teknik Kendaraan Ringan':
                  $color = 'bg-primary';
                  $icon = 'ion-android-car';
                  break;
                case 'Teknik Komputer dan Jaringan':
                  $color = 'bg-success';
                  $icon = 'ion-wifi';
                  break;
                case 'Teknik Sepeda Motor':
                  $color = 'bg-maroon';
                  $icon = 'ion-android-bicycle';
                  break;
                case 'Layanan Penunjang Kefarmasian Klinis dan Komunitas':
                  $color = 'bg-info';
                  $icon = 'ion-ios-medical';
                  break;
                default:
                  $color = 'bg-secondary';
                  $icon = 'ion-cube';
              }
            @endphp

            <div class="col-lg-3 col-6">
              <div class="small-box {{ $color }}">
                <div class="inner">
                  <h3>{{ $j->total_pendaftar ?? 0 }} / {{ $j->total_daftar_ulang ?? 0 }}</h3>
                  <p>{{ $j->nama_konsentrasi_keahlian }}</p>
                </div>
                <div class="icon">
                  <i class="ion {{ $icon }}"></i>
                </div>
                <a href="/data_pendaftaran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          @endforeach

          <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{ $jumlah_pendaftaran }}</h3>
                <p>Jumlah Pendaftar</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="/data_pendaftaran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $jumlah_daftar_ulang }}</h3>
                <p>Jumlah Daftar Ulang</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="/data_pendaftaran" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Asal Sekolah</th>
      <th>Belum Ukur Seragam + Belum DU</th>
      <th>Sudah Ukur Seragam + Belum DU</th>
      <th>Sudah DU + Belum Ukur Seragam</th>
      <th>Sudah DU + Sudah Ukur Seragam</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pendaftaran as $data)
      <tr>
        <td>{{ $data->nama_asal_sekolah }}</td>
        <td>{{ $data->belum_ukur_belum_du }}</td>
        <td>{{ $data->sudah_ukur_belum_du }}</td>
        <td>{{ $data->sudah_du_belum_ukur }}</td>
        <td>{{ $data->sudah_du_sudah_ukur }}</td>
        <td>{{ $data->total_pendaftaran_by_sekolah }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

      </div>
    </section>
  </div>
@endsection