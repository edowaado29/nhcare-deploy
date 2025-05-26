  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
<div class="mx-5 mt-4">
    <h5>Halo,</h5>
    <h5>Kami menerima permintaan untuk mengubah password akun Anda. Jika Anda tidak membuat permintaan ini, Anda dapat mengabaikan email ini dengan aman.</h5>
    <h5>Untuk mengatur ulang password Anda, silakan klik tautan di bawah ini:</h5>
    <a href="{{ route('validasi_forgot_password', ['token' => $token]) }}" class="btn btn-sm bg-gradient-primary my-3">Reset password</a>
    <h5>Tautan ini akan kedaluwarsa dalam 24 jam untuk alasan keamanan. Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi tim dukungan kami.</h5>
    <h5>Salam, Nurul Husna Care</h5>
</div>