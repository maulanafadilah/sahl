@extends('layout.master2')

@section('content')

        @if(session()->has('loginError'))
        <div class="alert alert-danger" role="alert">{{ session('loginError') }}</div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

<div class="page-content d-flex align-items-center justify-content-center">
        
  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('https://res.cloudinary.com/baby-daily-indonesia/image/upload/e_improve,w_300,h_600,c_thumb,g_auto/v1655302471/banners/THG_M405_01_bv3e6y.png') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">Simple Amanah <span>Lengkap</span></a>
              <h5 class="text-muted fw-normal mb-4">Selamat Datang!</h5>
              <form class="forms-sample" method="post" action="/login">
                @csrf
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Nomor Telepon</label>
                  <input type="text" class="form-control" name="nomor_telepon" id="userEmail" placeholder="Nomor Telepon">
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Kata Sandi</label>
                  <input type="password" class="form-control" id="userPassword" name="password" autocomplete="current-password" placeholder="Kata Sandi">
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">Login</button>

                </div>

              </form>
              <a href="{{ url('register') }}" class="d-block mt-3 text-muted">Tidak punya Akun? Daftar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection