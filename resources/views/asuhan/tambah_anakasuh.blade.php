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
        <h6 class="font-weight-bolder text-white mb-0">Tambah Anak Asuh</h6>
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
                  <form action="{{ route('tambahAnk')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                      <label for="nik" class="form-label text-secondary fs-6">NIK <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}">
                    </div>
                    <div class="mb-3">
                      <label for="nama" class="form-label text-secondary fs-6">Nama <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}">
                      @error('nama')
                      <script>
                        const ErrorNama = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label class="form-label text-secondary fs-6">Jenis Kelamin <span class="text-danger">*</span></label><br>
                      <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki">
                      <label for="laki-laki" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Laki-laki</label>
                      <input type="radio" id="perempuan" name="jenis_kelamin" style="margin-left: 3vh;" value="Perempuan">
                      <label for="perempuan" class="text-secondary" style="font-weight: 500; font-size: 1rem;">Perempuan</label>
                    </div>
                    <div class="mb-3">
                      <label for="tempat_lahir" class="form-label text-secondary fs-6">Tempat Lahir <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                    </div>
                    <div class="mb-3">
                      <label for="tanggal_lahir" class="form-label text-secondary fs-6">Tanggal Lahir <span class="text-danger">*</span></label>
                      <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    </div>
                    <div class="mb-3">
                      <label for="alamat" class="form-label text-secondary fs-6">Alamat <span class="text-danger">*</span></label>
                      <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label text-secondary fs-6">Keterangan <span class="text-danger">*</span></label>
                      <select class="form-control" id="keterangan" name="keterangan">
                        <option value="">Pilih Keterangan</option>
                        <option value="Yatim">Yatim</option>
                        <option value="Piatu">Piatu</option>
                        <option value="Yatim Piatu">Yatim Piatu</option>
                        <option value="Dhuafa">Dhuafa</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="asrama" class="form-label text-secondary fs-6">Asrama <span class="text-danger">*</span></label>
                      <select class="form-control" id="asrama" name="asrama">
                        <option value="">Pilih Asrama</option>
                        <option value="Asrama">Asrama</option>
                        <option value="Non Asrama">Non Asrama</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <label for="no_akta" class="form-label text-secondary fs-6">Nomor Akta <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_akta" name="no_akta" value="{{ old('no_akta') }}">
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="img_akta" class="text-secondary fs-6">Foto Akta (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                          <input type="file" class="form-control" id="img_akta" name="img_akta" onchange="aktaPreview(event)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <label for="no_kk" class="form-label text-secondary fs-6">Nomor KK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ old('no_kk') }}">
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="img_kk" class="text-secondary fs-6">Foto KK (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                          <input type="file" class="form-control" id="img_kk" name="img_kk" onchange="kkPreview(event)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <label for="no_skko" class="form-label text-secondary fs-6">Nomor SKKO <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_skko" name="no_skko" value="{{ old('no_skko') }}">
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                          <label for="img_skko" class="text-secondary fs-6">Foto SKKO (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                          <input type="file" class="form-control" id="img_skko" name="img_skko" onchange="skkoPreview(event)">
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="nama_sekolah" class="form-label text-secondary fs-6">Nama Sekolah <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah') }}">
                    </div>
                    <div class="mb-3">
                      <label for="tingkat" class="form-label text-secondary fs-6">Tingkat <span class="text-danger">*</span></label>
                      <select class="form-control" id="tingkat" name="tingkat" onchange="updateKelas()">
                        <option value="">Pilih Tingkat</option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP/Sederajat</option>
                        <option value="SMA">SMA/Sederajat</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="kelas" class="form-label text-secondary fs-6">Kelas <span class="text-danger">*</span></label>
                      <select class="form-control" id="kelas" name="kelas">
                        <option value="">Pilih Kelas</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="cabang" class="form-label text-secondary fs-6">Cabang <span class="text-danger">*</span></label>
                      <select class="form-control" id="cabang" name="cabang">
                        <option value="">Pilih Cabang</option>
                        <option value="Patrang">Patrang</option>
                        <option value="Arjasa">Arjasa</option>
                        <option value="Jelbuk">Jelbuk</option>
                        <option value="Kaliwates">Kaliwates</option>
                        <option value="Sumbersari">Sumbersari</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <div class="d-flex align-items-center justify-content-between mb-3">
                          <label for="prestasi" class="form-label text-secondary fs-6 mb-0">Prestasi <span class="text-danger">*</span></label>
                          <i class="fas fa-solid fa-plus" onclick="addField()" style="border: 3px solid green; color: green; padding: 3px; border-radius: 5px; cursor: pointer;"></i>
                      </div>
                      <div id="input_fields_wrap">
                          <div class="form-group">
                              <input type="hidden" name="nama_prestasi[]" class="form-control mb-2"/>
                          </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-6 col-sm-12">
                        <label for="nama_ayah" class="form-label text-secondary fs-6">Nama Ayah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="nik_ayah" class="form-label text-secondary fs-6">NIK Ayah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nik_ayah" name="nik_ayah" value="{{ old('nik_ayah') }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-6 col-sm-12">
                        <label for="nama_ibu" class="form-label text-secondary fs-6">Nama Ibu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="nik_ibu" class="form-label text-secondary fs-6">NIK Ibu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" value="{{ old('nik_ibu') }}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-6 col-sm-12">
                        <label for="nama_wali" class="form-label text-secondary fs-6">Nama Wali <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="{{ old('nama_wali') }}">
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <label for="nik_wali" class="form-label text-secondary fs-6">NIK Wali <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nik_wali" name="nik_wali" value="{{ old('nik_wali') }}">
                      </div>
                    </div>
                    <div class="mb-3">
                      <div class="form-group">
                        <label for="img_anak" class="text-secondary fs-6">Foto Anak Asuh (Maksimal 2MB) <span class="text-danger">*</span></label><br>
                        <input type="file" class="form-control" id="img_anak" name="img_anak" onchange="fotoPreview(event)">
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="col-6">
                        <a href="{{route('anakasuh')}}" class="btn btn-sm bg-gradient-danger w-100">Kembali</a>
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
            <div class="card">
              <div class="card-body px-0 pt-0 pb-2 mt-3">
                <div class="container">
                  <div class="mb-3">
                    <div class="preview">
                      <label class="text-secondary fs-6">Pratinjau Foto Anak Asuh</label><br>
                      <img src="{{asset('assets/img/no_image.png')}}" class="mb-3" id="fotoPreview" style="width: 100%; height: 400px; border: 2px solid #d4d4d4; border-radius: 10px;">
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
                      <label class="text-secondary fs-6">Pratinjau Akta</label><br>
                      <img src="{{asset('assets/img/no_image.png')}}" class="mb-3" id="aktaPreview" style="width: 100%; height: 270px; border: 2px solid #d4d4d4; border-radius: 10px;">
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
                      <label class="text-secondary fs-6">Pratinjau Kartu Keluarga</label><br>
                      <img src="{{asset('assets/img/no_image.png')}}" class="mb-3" id="kkPreview" style="width: 100%; height: 270px; border: 2px solid #d4d4d4; border-radius: 10px;">
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
                      <label class="text-secondary fs-6">Pratinjau Surat Keterangan Kematian Orangtua</label><br>
                      <img src="{{asset('assets/img/no_image.png')}}" class="mb-3" id="skkoPreview" style="width: 100%; height: 270px; border: 2px solid #d4d4d4; border-radius: 10px;">
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
  function fotoPreview(event) {
    const reader = new FileReader();
    const image = document.getElementById('fotoPreview');
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
  
  function aktaPreview(event) {
    const reader = new FileReader();
    const image = document.getElementById('aktaPreview');
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

  function kkPreview(event) {
    const reader = new FileReader();
    const image = document.getElementById('kkPreview');
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

  function skkoPreview(event) {
    const reader = new FileReader();
    const image = document.getElementById('skkoPreview');
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
    function updateKelas() {
        var tingkat = document.getElementById("tingkat").value;
        var kelas = document.getElementById("kelas");

        kelas.innerHTML = '<option value="">Pilih Kelas</option>';

        if (tingkat === "TK") {
            var options = ['<option value="TK Kecil">TK Kecil</option>', '<option value="TK Besar">TK Besar</option>'];
        } else if (tingkat === "SD") {
            var options = [
                '<option value="1">1</option>',
                '<option value="2">2</option>',
                '<option value="3">3</option>',
                '<option value="4">4</option>',
                '<option value="5">5</option>',
                '<option value="6">6</option>'
            ];
        } else if (tingkat === "SMP") {
            var options = [
                '<option value="7">7</option>',
                '<option value="8">8</option>',
                '<option value="9">9</option>'
            ];
        } else if (tingkat === "SMA") {
            var options = [
                '<option value="10">10</option>',
                '<option value="11">11</option>',
                '<option value="12">12</option>'
            ];
        }

        if (options) {
            options.forEach(function(option) {
                kelas.innerHTML += option;
            });
        }
    }
</script>
<script>
  if (typeof ErrorNama !== 'undefined') {
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
    }
  }
</script>

<script>
  function addField() {
      var wrapper = document.getElementById("input_fields_wrap");
      var newField = document.createElement("div");
      newField.className = "form-group";
      newField.innerHTML = '<div class="d-flex align-items-center justify-content-between mb-2"><input type="text" name="nama_prestasi[]" class="form-control mb-2" /><i class="fas fa-solid fa-minus" onclick="removeField(this)" style="border: 3px solid red; color: red; padding : 3px; margin-left: 10px; border-radius: 5px; cursor: pointer;"></i></div>';
      wrapper.appendChild(newField);
  }

  function removeField(button) {
      var field = button.parentNode;
      field.parentNode.removeChild(field);
  }
</script>
@endsection