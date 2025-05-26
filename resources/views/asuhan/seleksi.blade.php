@extends('layouts.template')

@section('content')
  <main class="main-content position-relative border-radius-lg ">
  <style>
    .colored-toast.swal2-icon-error {
      background-color: #f27474 !important;
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
          <h6 class="font-weight-bolder text-white mb-0">Seleksi</h6>
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
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>DATA SELEKSI</h6>
            </div>
            <div class="container mt-3">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <a class="btn btn-sm bg-gradient-primary" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal">Seleksi</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <input class="form-control" id="search" type="text" placeholder="Masukkan kata kunci ...">
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2 mt-3">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-success text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-success text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-uppercase text-success text-xxs font-weight-bolder opacity-7 ps-2">Keterangan</th>
                      <th class="text-uppercase text-success text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                      <th class="text-uppercase text-success text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Prestasi</th>
                      <th class="text-uppercase text-success text-xxs font-weight-bolder opacity-7 ps-2">Total Skor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="3" class="text-center">Anda belum seleksi data anak asuh.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade align-items-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Jumlah Anak Asuh</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="seleksiAnakasuh" method="post" enctype="multipart/form-data">
          <div class="modal-body">
              @csrf
              <input class="form-control" type="text" name="jumlah_anak">
              @error('jumlah_anak')
              <script>
                const ErrorJumlah = '{{ $message }}';
              </script>
              @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn bg-gradient-success">Lanjutkan</button>
            </div>
          </form>
          </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  if (typeof ErrorJumlah !== 'undefined') {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-right',
      iconColor: 'white',
      customClass: {
        popup: 'colored-toast swal2-icon-error',
      },
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    })
    Toast.fire({
      icon: 'warning',
      title: "Form Tidak Boleh Kosong",
    });
    if (typeof ErrorJumlah !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorJumlah,
      });
    } 
  }
</script>
@endsection