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
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Kedonaturan</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Tambah Kedonaturan</h6>
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
                  <form action="{{ route('tambahDon')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (Session::has('fail'))
                    <script>
                      const ErrorMessage = "{{ Session::get('fail') }}";
                    </script>
                    @endif
                    <div class="mb-3">
                      <label for="nama_donatur" class="form-label text-secondary fs-6">Nama <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('nama_donatur') is-invalid @enderror" id="nama_donatur" name="nama_donatur" value="{{ old('nama_donatur')}}">
                      @error('nama_donatur')
                      <script>
                        const ErrorNama = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="nomor_handphone" class="form-label text-secondary fs-6">Nomor Handphone <span class="text-danger">*</span></label>
                      <input type="regex" class="form-control" id="nomor_handphone" name="nomor_handphone" value="{{ old('nomor_handphone')}}" onkeypress="return hanyaAngka(event)" oninput="cekPanjangInput(this)">
                    </div>
                    <div class="mb-3">
                      <label for="alamat" class="form-label text-secondary fs-6">Alamat</label>
                      <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="mb-3">
                      <label class="form-label text-secondary fs-6">Jenis Kelamin <span class="text-danger">*</span></label><br>
                      <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki">
                      <label for="laki-laki" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Laki-laki</label>

                      <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" style="margin-left: 3vh;">
                      <label for="perempuan" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Perempuan</label>
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label text-secondary fs-6">Email <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email')}}">
                      @error('email')
                      <script>
                        const ErrorEmail = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="mb-3 position-relative">
                      <label for="passwordd" class="form-label text-secondary fs-6">
                        Password <span class="text-danger">*</span>
                      </label>
                      <input type="password" class="form-control @error('passwordd') is-invalid @enderror" id="passwordd" name="passwordd" value="{{ old('passwordd')}}">
                      <i class="fa fa-eye position-absolute" id="togglePassword" style="cursor: pointer; right: 11.9px; top: 46.195px;"></i>
                      @error('passwordd')
                      <script>
                        const ErrorPassword = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="pertanyaan" class="form-label text-secondary fs-6">Pertanyaan Keamanan <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('pertanyaan') is-invalid @enderror" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan')}}">
                    </div>
                    <div class="mb-3">
                      <label for="jawaban" class="form-label text-secondary fs-6">Jawaban Keamanan <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('jawaban') is-invalid @enderror" id="jawaban" name="jawaban" value="{{ old('jawaban')}}">
                    </div>
                    <div class="form-group">
                      <label for="foto_donatur" class="text-secondary fs-6">Foto Donatur (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                      <input type="file" class="form-control" id="foto_donatur" name="foto_donatur" onchange="previewImage(event)">
                      @error('foto_donatur')
                      <script>
                        const ErrorFoto = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="row mt-4">
                      <div class="col-6">
                        <a href="{{ route('kedonaturan')}}" class="btn btn-sm bg-gradient-danger w-100">Kembali</a>
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
                      <label class="text-secondary fs-6">Pratinjau Foto Donatur</label><br>
                      <img src="{{asset('assets/img/no_image.png')}}" class="mb-3" id="imagePreview" style="width: 100%; height: 400px; border: 2px solid #d4d4d4; border-radius: 10px;">
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

<script>
  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }

  function cekPanjangInput(input) {
    if (input.value.length > 13) {
      input.value = input.value.slice(0, 13);
    }
  }
</script>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#passwordd');

  togglePassword.addEventListener('click', function(e) {
    // Toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle the eye icon
    this.classList.toggle('fa-eye-slash');
  });
</script>

<script>
  function previewImage(event) {
    const reader = new FileReader();
    const image = document.getElementById('imagePreview');
    image.style.maxWidth = '100%';
    image.style.maxHeight = '400px';
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
  if (typeof ErrorNama !== 'undefined' || typeof ErrorEmail !== 'undefined' || typeof ErrorPassword !== 'undefined' || typeof ErrorMessage !== 'undefined' || typeof ErrorFoto !== 'undefined') {
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
    } else if (typeof ErrorEmail !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorEmail,
      });
    } else if (typeof ErrorPassword !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorPassword,
      });
    } else if (typeof ErrorMessage !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorMessage,
      });
    } else if (typeof ErrorFoto !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorFoto,
      });
    } 
  }
</script>
@endsection