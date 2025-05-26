@extends('layouts.template')

@section('content')
<main class="main-content position-relative border-radius-lg ">
  <style>
    .colored-toast.swal2-icon-success {
      background-color: #a5dc86 !important;
    }
  </style>
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Asuhan</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Detail Anak Asuh</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="{{route('profile')}}" class="nav-link text-white font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>
            </a>
          </li>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="card">
      <div style="margin-left: 5vh;" class="py-3">
        <a href="{{ route('anakasuh')}}">
          <img src="{{asset ('assets/img/back-button.png') }}" style="width: 5vh; opacity: 50%;">
        </a>
      </div>
      <hr class="horizontal dark mt-0">
      <div class="row">
        <div class="col-lg-3 col-sm-12 px-5 pb-3">
          <img src="{{ $ank->img_anak !== null ? asset('/storage/anakasuhs/Foto/' . $ank->img_anak) : asset('/assets/img/no_image.png') }}" style="width: 100%; border: 2px solid #d4d4d4; border-radius: 10px;">
        </div>
        <div class="col-lg-9 col-sm-12">
          <div style="margin-top: 5vh;">
            <h2 style="font-size: 1.25rem; font-weight: 400; color: grey;">{{$ank->id_anakasuh}}</h2>
            <h3 style="font-size: 2.25rem;">{{$ank->nama}}</h3>
            <h4 style="color: #73A578; font-weight: 400;">{{$ank->nik}}</h4>
          </div>
        </div>
      </div>
      <hr class="horizontal dark mt-0">
      <div class="row mt-3 pb-3">
        <div class="col-4" style="padding-left: 60px;">
          <h5 style="font-weight: 500; font-size: 1.15rem;">Jenis Kelamin</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Tempat / Tanggal Lahir</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Alamat</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Keterangan</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Asrama</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Nama Sekolah</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Tingkat</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Kelas</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Cabang</h5>
          @foreach($pres as $p)
            <h5 style="font-weight: 500; font-size: 1.15rem;">Prestasi {{ $loop->iteration }}</h5>
          @endforeach
          <h5 style="font-weight: 500; font-size: 1.15rem;">Nomor Akta</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Nomor KK</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Nomor SKKO</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Nama Ayah</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">NIK Ayah</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Nama Ibu</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">NIK Ibu</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Nama Wali</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">NIK Wali</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">Status</h5>
        </div>
        <div class="col-1">
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          @foreach($pres as $p)
            <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          @endforeach
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">:</h5>
        </div>
        <div class="col-7">
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->jenis_kelamin}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->tempat_lahir}} / {{$ank->tanggal_lahir}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->alamat}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->keterangan}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->asrama}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->nama_sekolah}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->tingkat}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->kelas}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->cabang}}</h5>
          @foreach($pres as $p)
            <h5 style="font-weight: 500; font-size: 1.15rem;">{{$p->nama_prestasi}}</h5>
          @endforeach
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->no_akta}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->no_kk}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->no_skko}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->nama_ayah}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->nik_ayah}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->nama_ibu}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->nik_ibu}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->nama_wali}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->nik_wali}}</h5>
          <h5 style="font-weight: 500; font-size: 1.15rem;">{{$ank->status_anak}}</h5>
        </div>
      </div>
      <hr class="horizontal dark mt-0">
      <div class="row pb-5">
        <div class="col-lg-4 col-sm-12" style="padding-left: 60px;">
          <h5 style="font-weight: 500; font-size: 1.15rem;">Pratinjau Foto Akta</h5>
          <img src="{{ $ank->img_akta !== null ? asset('/storage/anakasuhs/Akta/' . $ank->img_akta) : asset('/assets/img/no_image.png') }}" style="width: 100%; height: 220px; border: 2px solid #d4d4d4; border-radius: 10px;">
        </div>
        <div class="col-lg-4 col-sm-12" style="padding-left: 30px; padding-right: 30px;">
          <h5 style="font-weight: 500; font-size: 1.15rem;">Pratinjau Foto KK</h5>
          <img src="{{ $ank->img_kk !== null ? asset('/storage/anakasuhs/KK/' . $ank->img_kk) : asset('/assets/img/no_image.png') }}" style="width: 100%; height: 220px; border: 2px solid #d4d4d4; border-radius: 10px;">
        </div>
        <div class="col-lg-4 col-sm-12" style="padding-right: 60px;">
          <h5 style="font-weight: 500; font-size: 1.15rem;">Pratinjau Foto SKKO</h5>
          <img src="{{ $ank->img_skko !== null ? asset('/storage/anakasuhs/SKKO/' . $ank->img_skko) : asset('/assets/img/no_image.png') }}" style="width: 100%; height: 220px; border: 2px solid #d4d4d4; border-radius: 10px;">
        </div>
      </div>
    </div>
  </div>
</main>
@endsection