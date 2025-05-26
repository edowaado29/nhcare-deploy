@extends('layouts.template')

@section('content')
  <main class="main-content position-relative border-radius-lg ">
  </style>
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
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
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-2 text-uppercase font-weight-bold">Total Donasi</p>
                    <h5 class="font-weight-bolder">
                      Rp. {{$sum_donasi}}
                    </h5>
                    <div class="mb-4"></div>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-2 text-uppercase font-weight-bold">Total Pengasuh</p>
                    <h5 class="font-weight-bolder">
                      {{$count_pengasuh}}
                    </h5>
                    <div class="mb-4"></div>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-2 text-uppercase font-weight-bold">Total Anak Asuh</p>
                    <h5 class="font-weight-bolder">
                      {{$count_anakasuh}}
                    </h5>
                    <div class="mb-4"></div>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-2 text-uppercase font-weight-bold">Total Donatur</p>
                    <h5 class="font-weight-bolder">
                      {{$count_donatur}}
                    </h5>
                    <div class="mb-4"></div>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-4">
        <div class="card-body mb-3">
          <h4 class="mb-3">ACARA HARI INI</h4>
          <hr class="horizontal dark mt-0">
          @forelse ($acra as $acara)
          <div class="card shadow-lg mt-4">
            <div class="card-body p-3">
              <div class="row gx-4">
                <div class="col-auto">
                  <div class="avatar avatar-xl position-relative">
                    <img src="{{ asset('/storage/acaras/' .$acara->gambarAcara)}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                  </div>
                </div>
                <div class="col-auto my-auto">
                  <div class="h-100">
                    <h5 class="mb-1">
                      {{ $acara->namaAcara }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                      {{ $acara->tanggalAcara }}
                    </p>
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                  <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                      <li class="nav-item">
                        <a href="{{ route('detail_acara', $acara->id)}}" class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center btn bg-gradient-primary text-white">
                          <span class="ms-2">Detail</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <p class="text-center">Tidak ada acara hari ini</p>
          @endforelse
        </div>
      </div>
    </div>
  </main>
@endsection