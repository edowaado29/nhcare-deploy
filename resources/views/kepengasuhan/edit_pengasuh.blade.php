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
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">Kepengasuhan</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Edit Pengasuh</h6>
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
                  <form action="{{ route('update_pengasuh', $peng->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      <label for="nbm" class="form-label text-secondary fs-6">NBM <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="nbm" name="nbm" value="{{ old('nbm', $peng->nbm) }}">
                    </div>

                    <div class="mb-3">
                      <label for="nama_pengasuh" class="form-label text-secondary fs-6">Nama Pengasuh <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('nama_pengasuh') is-invalid @enderror" id="nama_pengasuh" name="nama_pengasuh" value="{{ old('nama_pengasuh', $peng->nama_pengasuh) }}">
                      @error('nama_pengasuh')
                      <script>
                        const ErrorNama = '{{ $message }}';
                      </script>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label class="form-label text-secondary fs-6">Jenis Kelamin <span class="text-danger">*</span></label><br>
                      <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', $peng->jenis_kelamin) == 'Laki-laki' ? 'checked' : '' }}>
                      <label for="laki-laki" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Laki-laki</label>

                      <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" style="margin-left: 3vh;" {{ old('jenis_kelamin', $peng->jenis_kelamin) == 'Perempuan' ? 'checked' : '' }}>
                      <label for="perempuan" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Perempuan</label>
                    </div>

                    <div class="mb-3">
                      <label for="tempat_lahir" class="form-label text-secondary fs-6">Tempat Lahir <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $peng->tempat_lahir) }}">
                    </div>

                    <div class="mb-3">
                      <label for="tanggal_lahir" class="form-label text-secondary fs-6">Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $peng->tanggal_lahir) }}">
                    </div>

                    <div class="mb-3">
                      <label for="last_pend" class="form-label text-secondary fs-6">Pendidikan Terakhir</label>
                      <select class="form-control" id="last_pend" name="pendidikan_terakhir">
                        <option value="">Pilih Pendidikan Terakhir</option>
                        <option value="SD" {{ old('pendidikan_terakhir', $peng->pendidikan_terakhir) == 'SD' ? 'selected' : ''}}>SD</option>
                        <option value="SMP" {{ old('pendidikan_terakhir', $peng->pendidikan_terakhir) == 'SMP' ? 'selected' : ''}}>SMP/Sederajat</option>
                        <option value="SMA" {{ old('pendidikan_terakhir', $peng->pendidikan_terakhir) == 'SMA' ? 'selected' : ''}}>SMA/Sederajat</option>
                        <option value="S1" {{ old('pendidikan_terakhir', $peng->pendidikan_terakhir) == 'S1' ? 'selected' : ''}}>S1</option>
                        <option value="S2" {{ old('pendidikan_terakhir', $peng->pendidikan_terakhir) == 'S2' ? 'selected' : ''}}>S2</option>
                        <option value="S3" {{ old('pendidikan_terakhir', $peng->pendidikan_terakhir) == 'S3' ? 'selected' : ''}}>S3</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_jabatan" class="form-label text-secondary fs-6">Jabatan <span class="text-danger">*</span></label>
                      <select id="id_jabatan" class="form-control @error('id_jabatan') is-invalid @enderror" name="id_jabatan">
                        <option value="">Pilih Jabatan</option>
                        @foreach($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}" {{ old('id_jabatan', $peng->id_jabatan) == $jabatan->id ? 'selected' : '' }}>
                          {{ $jabatan->nama_jabatan }}
                        </option>
                        @endforeach
                      </select>
                      @error('id_jabatan')
                      <script>
                        const ErrorJabat = '{{ $message }}';
                      </script>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="alamat" class="form-label text-secondary fs-6">Alamat <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $peng->alamat) }}">
                    </div>

                    <div class="mb-3">
                      <label for="nomor_handphone" class="form-label text-secondary fs-6">Nomor Handphone <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" value="{{ old('nomor_handphone', $peng->nomor_handphone) }}">
                    </div>

                    <div class="mb-3">
                      <label for="email" class="form-label text-secondary fs-6">Email <span class="text-danger">*</span></label>
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $peng->email) }}">
                      @error('email')
                      <script>
                        const ErrorEmail = '{{ $message }}';
                      </script>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="tanggal_masuk" class="form-label text-secondary fs-6">Tanggal Masuk <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', $peng->tanggal_masuk) }}">
                    </div>

                    <div class="mb-3">
                      <label class="form-label text-secondary fs-6">Status Kepengasuhan <span class="text-danger">*</span></label><br>
                      <input type="radio" name="status_pengasuh" id="aktif" value="Aktif" {{ old('status_pengasuh', $peng->status_pengasuh) == 'Aktif' ? 'checked' : '' }}>
                      <label for="aktif" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Aktif</label>

                      <input type="radio" name="status_pengasuh" id="tidak_aktif" value="Tidak Aktif" style="margin-left: 3vh;" {{ old('status_pengasuh', $peng->status_pengasuh) == 'Tidak Aktif' ? 'checked' : '' }}>
                      <label for="tidak_aktif" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Tidak Aktif</label>
                    </div>

                    <div class="form-group">
                      <label for="foto_kartukeluarga" class="text-secondary fs-6">Foto Kartu Keluarga (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                      <input type="file" class="form-control" id="foto_kartukeluarga" name="foto_kartukeluarga" onchange="kkPreview(event)">
                      @error('foto_kartukeluarga')
                      <script>
                        const ErrorKK = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="foto_ktp" class="text-secondary fs-6">Foto Kartu Tanda Penduduk (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                      <input type="file" class="form-control" id="foto_ktp" name="foto_ktp" onchange="ktpPreview(event)">
                      @error('foto_ktp')
                      <script>
                        const ErrorKTP = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="foto_pengasuh" class="text-secondary fs-6">Foto Pengasuh (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                      <input type="file" class="form-control" id="foto_pengasuh" name="foto_pengasuh" onchange="pengasuhPreview(event)">
                      @error('foto_pengasuh')
                      <script>
                        const ErrorFoto = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="row mt-4">
                      <div class="col-6">
                        <a href="{{ route('pengasuh') }}" class="btn btn-sm bg-gradient-danger w-100">Kembali</a>
                      </div>
                      <div class="col-6">
                        <button type="submit" class="btn btn-sm bg-gradient-success w-100">Edit</button>
                      </div>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        <div class="col-lg-5 col-md-5 col-sm-12 mt-3">
          <div class="card">
            <div class="card-body px-0 pt-0 pb-2 mt-3">
              <div class="container">
                <div class="mb-3">
                  <div class="preview">
                    <label class="text-secondary fs-6">Pratinjau Foto Pengasuh</label><br>
                    <img src="{{ asset('/storage/pengasuhs/foto/' .$peng->foto_pengasuh)}}" class="mb-3" id="pengasuhPreview" style="width: 100%; height: 400px; border: 2px solid #d4d4d4; border-radius: 10px;">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-4">
            <div class="card-body px-0 pt-0 pb-2 mt-3">
              <div class="container">
                <div class="mb-3">
                  <div class="preview">
                    <label class="text-secondary fs-6">Pratinjau Foto Kartu Keluarga (KK)</label><br>
                    <img src="{{ asset('/storage/pengasuhs/KK/' .$peng->foto_kartukeluarga)}}" class="mb-3" id="kkPreview" style="width: 100%; height: 270px; border: 2px solid #d4d4d4; border-radius: 10px;">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-4">
            <div class="card-body px-0 pt-0 pb-2 mt-3">
              <div class="container">
                <div class="mb-3">
                  <div class="preview">
                    <label class="text-secondary fs-6">Pratinjau Foto Kartu Tanda Penduduk (KTP)</label><br>
                    <img src="{{ asset('/storage/pengasuhs/KTP/' .$peng->foto_ktp)}}" class="mb-3" id="ktpPreview" style="width: 100%; height: 270px; border: 2px solid #d4d4d4; border-radius: 10px;">
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
  function kkPreview(event) {
    const reader = new FileReader();
    const image = document.getElementById('kkPreview');
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

  function ktpPreview(event) {
    const reader = new FileReader();
    const image = document.getElementById('ktpPreview');
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

  function pengasuhPreview(event) {
    const reader = new FileReader();
    const image = document.getElementById('pengasuhPreview');
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
   if (typeof ErrorNama !== 'undefined' || typeof ErrorJabat !== 'undefined' || typeof ErrorEmail !== 'undefined' || typeof ErrorKK !== 'undefined' || typeof ErrorKK !== 'undefined' || typeof ErrorFoto !== 'undefined') {
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
    if (typeof ErrorNama !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorNama,
      });
    } else if (typeof ErrorJabat !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorJabat,
      });
    } else if (typeof ErrorEmail !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorEmail,
      });
    } else if (typeof ErrorKK !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorKK,
      });
    } else if (typeof ErrorKTP !== 'undefined') {
      Toast.fire({
        icon: 'warning',
        title: ErrorKTP,
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