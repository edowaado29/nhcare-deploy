<style>
  .bg-nav{
    background-image: url('{{ asset("assets/img/bg-nav.png") }}');
    background-position-y: 50%;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
<div class="min-height-300 position-fixed w-100" style="background: #73A578;"></div>
  <div class="position-fixed w-100 min-height-300 top-0 bg-nav">
    <span class="mask bg-success opacity-7"></span>
  </div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{route('dashboard')}}">
        <img src="{{asset ('assets/img/dashboard-logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse h-auto w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('dashboard')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/dashboard.png') }}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('kedonaturan')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/kedonaturan.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Kedonaturan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('donasi')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/donasi.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Donasi</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Kepengasuhan</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('jabatan')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/jabatan.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Jabatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('pengasuh')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/pegawai.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Pengasuh</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Asuhan</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('anakasuh')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/anakasuh.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Anak Asuh</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('seleksi')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/absensi.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Seleksi Anak Asuh</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Layanan</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('acara')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/acara.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Acara</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('artikel')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/artikel.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Artikel</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{route('program')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <img src="{{asset ('assets/img/program.png')}}" style="height: 2.75vh;">
            </div>
            <span class="nav-link-text ms-1">Program</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>