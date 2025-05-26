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
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Layanan</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Tambah Acara</h6>
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
        <div class="row">
          <div class="col-lg-7 col-md-7 col-sm-12 mt-3">
            <div class="card" style="height: 100%">
              <div class="card-body px-0 pt-0 pb-2 mt-3">
                <div class="container">
                  <form action="{{ route('tambahAcr')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="acara_name" class="form-label text-secondary fs-6">Nama Acara <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('namaAcara') is-invalid @enderror" id="acara_name" name="namaAcara" value="{{ old('namaAcara') }}">

                      @error('namaAcara')
                      <script>
                        const ErrorNama = '{{ $message }}';
                      </script>
                      @enderror

                    </div>
                    <div class="mb-3">
                      <label for="acara_desc" class="form-label text-secondary fs-6">Deskripsi Acara <span class="text-danger">*</span></label>
                      <textarea type="text" class="form-control @error('deskripsiAcara') is-invalid @enderror" id="acara_desc" name="deskripsiAcara" rows="5">{{ old('deskripsiAcara') }}</textarea>
                      @error('deskripsiAcara')
                      <script>
                        const ErrorDeskripsi = '{{ $message }}'; 
                      </script>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="acara_tanggal" class="form-label text-secondary fs-6">Tanggal Acara <span class="text-danger">*</span></label>
                      <input type="datetime-local" class="form-control @error('tanggalAcara') is-invalid @enderror" id="acara_tanggal" name="tanggalAcara" value="{{ old('tanggalAcara') }}">

                      @error('tanggalAcara')
                      <script>
                        const ErrorDate = '{{ $message }}'; 
                      </script>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="acara_img" class="text-secondary fs-6">Gambar Acara (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                      <input type="file" class="form-control @error('gambarAcara') is-invalid @enderror" id="acara_img" name="gambarAcara" onchange="previewImage(event)">

                      @error('gambarAcara')
                      <script>
                        const ErrorGambar = '{{ $message }}'; 
                      </script>
                      @enderror
                    </div>
                    <div class="row mt-4">
                      <div class="col-6">
                        <a href="{{route('acara')}}" class="btn btn-sm bg-gradient-danger w-100">Kembali</a>
                      </div>
                      <div class="col-6">
                        <button type="submit" class="btn btn-sm bg-gradient-success w-100">Tambah</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-5 col-sm-12 mt-3">
            <div class="card" style="height: 100%">
              <div class="card-body px-0 pt-0 pb-2 mt-3">
                <div class="container">
                  <div class="mb-3">
                    <div class="preview">
                      <label class="text-secondary fs-6">Pratinjau Gambar Program</label><br>
                      <img src="{{asset('assets/img/no_image.png')}}" class="mb-3" id="imagePreview" style="width: 100%; height: 270px; border: 2px solid #d4d4d4; border-radius: 10px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('acara_desc');
</script>
<script>
  function previewImage(event) {
    const reader = new FileReader();
    const image = document.getElementById('imagePreview');
    image.style.maxWidth = '100%';
    image.style.maxHeight = '270px';
    image.style.display = 'none';

    reader.onload = function() {
        if (reader.readyState === FileReader.DONE) {
            image.src = reader.result;
            image.style.display = 'block';
        }
    }

    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
  }
</script>

<script>
  // Check if ErrorImage, ErrorJudul, or ErrorDeskripsi variable exists and display toast message if any of them does
  if (typeof ErrorNama !== 'undefined' || typeof ErrorDeskripsi !== 'undefined' || typeof ErrorDate !== 'undefined' || typeof ErrorGambar !== 'undefined') {
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
    if (typeof ErrorNama !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorNama,
      });
    } else if (typeof ErrorDeskripsi !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorDeskripsi,
      });
    } else if (typeof ErrorDate !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorDate,
      });
    } else if (typeof ErrorGambar !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorGambar,
      });
    }
  }
</script>
@endsection