<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/nhcare-logo-color.png') }}">
  <title>
    Nurul Husna Care
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  <style>
    .colored-toast.swal2-icon-success {
      background-color: #a5dc86 !important;
    }
    .colored-toast.swal2-icon-error {
        background-color: #f27474 !important;
    }
    </style>
</head>

<body>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Halaman Login</h4>
                  <p class="mb-0">Masukkan email dan password yang benar!</p>
                </div>
                <div class="card-body">
                  <form role="form" action="{{route('loginUser')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (Session::has('fail'))
                      <script>
                        const AuthError = "{{ Session::get('fail') }}";
                      </script>
                    @endif
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" placeholder="Email" aria-label="Email" value="{{ old('email', Cookie::get('email')) }}">
                      @error('email')
                      <script>
                        const ErrorEmail = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="passwordd" name="passwordd" placeholder="Password" aria-label="Password" value="{{ old('passwordd', Cookie::get('password')) }}">
                      <i class="fa fa-eye position-absolute" id="togglePassword" style="cursor: pointer; right: 40px; top: 195px;"></i>
                      @error('passwordd')
                      <script>
                        const ErrorPassword = '{{ $message }}';
                      </script>
                      @enderror
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me" {{ Cookie::has('email') ? 'checked' : '' }}>
                          <label class="form-check-label" for="rememberMe">Ingatkan saya</label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="card-footer text-end pt-0 px-lg-2 px-1">
                          <p class="text-sm mx-auto">
                            <a href="{{route('forgot_password')}}" class="text-success text-gradient font-weight-bold">Lupa password</a>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg bg-gradient-success btn-lg w-100 mb-0">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-success h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('assets/img/bg-login.jpg');
                background-size: cover;">
                <span class="mask bg-gradient-success opacity-5"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
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
  if (typeof ErrorEmail !== 'undefined' || typeof ErrorPassword !== 'undefined' || typeof AuthError !== 'undefined') {
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
    if(typeof ErrorEmail !== 'undefined'){
      Toast.fire({
        icon: 'warning',
        title: ErrorEmail
      });
    } else if(typeof ErrorPassword !== 'undefined'){
      Toast.fire({
        icon: 'warning',
        title: ErrorPassword
      });
    } else if(typeof AuthError !== 'undefined'){
      Toast.fire({
        icon: 'warning',
        title: AuthError
      });
    }
  }
</script>
@if (Session::has('logoutSuccess'))
  <script>
    const Toast2 = Swal.mixin({
      toast: true,
      position: 'top-right',
      iconColor: 'white',
      customClass: {
        popup: 'colored-toast',
      },
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    })
    Toast2.fire({
      icon: 'success',
      title: "{{ Session::get('logoutSuccess') }}"
    });
  </script>
  {{Session::pull('logoutSuccess', 'Logout Berhasil!')}}
  @endif
  
@if (Session::has('ResetPasswordSuccess'))  
  <script>
    const Toast3 = Swal.mixin({
      toast: true,
      position: 'top-right',
      iconColor: 'white',
      customClass: {
        popup: 'colored-toast',
      },
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
    })
    Toast3.fire({
      icon: 'success',
      title: "{{ Session::get('ResetPasswordSuccess') }}"
    });
  </script>
  {{Session::pull('ResetPasswordSuccess', 'Reset Password Berhasil!')}}
  @endif
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>

</html>