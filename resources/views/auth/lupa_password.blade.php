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
    .bg-nav{
        background-image: url('{{ asset("assets/img/bg-nav.png") }}');
        background-position-y: 50%;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
</head>

<body class="hold-transition login-page">
<div class="position-fixed w-100 min-height-300 top-0 bg-nav">
    <span class="mask bg-success opacity-7"></span>
  </div>
    <div class="login-box d-flex justify-content-center align-items-center">
        <div class="card card-outline card-primary w-35 p-5" style="margin-top: 25vh; box-shadow: 0px 19px 50px 0px rgba(0,0,0,0.1);">
            <div class="card-header text-center">
                <h1 class="h1"><b>Lupa</b> Password</h1>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masukkan E-Mail yang terdaftar</p>

                <form action="{{ route('forgot_password_act') }}" method="post">
                    @csrf
                    <div class="input-group my-4">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    @error('email')
                      <script>
                        const ErrorEmail = '{{ $message }}';
                      </script>
                      @enderror
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn bg-gradient-success btn-block w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box -->
    <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

    @if ($message = Session::get('success'))
    <script>
        const Toast = Swal.mixin({
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
        Toast.fire({
            icon: 'success',
            title: "{{ $message }}"
        });
        </script>
    @endif

    <script>
        if (typeof ErrorEmail !== 'undefined') {
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
            if (typeof ErrorEmail !== 'undefined') {
            Toast.fire({
                icon: 'warning',
                title: ErrorEmail,
            });
            }
        }
    </script>
</body>

</html>