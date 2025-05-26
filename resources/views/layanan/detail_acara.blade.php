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
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Layanan</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Detail Acara</h6>
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
        <a href="{{ route('acara')}}">
          <img src="{{asset ('assets/img/back-button.png') }}" style="width: 5vh; opacity: 50%;">
        </a>
      </div>
      <hr class="horizontal dark mt-0">
      <div class="px-5">
        <img src="{{ $acra->gambarAcara !== null ? asset('/storage/acaras/' . $acra->gambarAcara) : asset('/assets/img/no_image.png') }}" style="width: 100%; border: 2px solid #d4d4d4; border-radius: 10px;">
        <h2 class="pt-4">{{$acra->namaAcara}}</h2>
        <h3 class="pb-3" style="font-size: 1.25rem; font-weight: 500; color: grey;">{{$acra->tanggalAcara}}</h3>
        <p class="pb-5">{{$acra->deskripsiAcara}}</p>
      </div>
    </div>
  </div>
</main>
@endsection