@extends('layout.master2')

@section('content')
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
              <a href="#" class="noble-ui-logo d-block mb-2">Simple Amanah<span>Lengkap</span></a>
              <h5 class="text-muted fw-normal mb-4">Daftar Akun Gratis!</h5>
              <form class="forms-sample" method="POST" action="{{ url('/register/') }}">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputUsername1" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nama Lengkap" name="nama_lengkap" required>
                </div>
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Nomor Telepon</label>
                  <input type="number" class="form-control" id="userEmail" placeholder="Contoh: 0812345678910" name="nomor_telepon" required>
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Kata Sandi</label>
                  <input type="password" class="form-control" id="userPassword" autocomplete="current-password" placeholder="Kata Sandi" name="password" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputUsername1" class="form-label">Nama Perusahaan/UMKM</label>
                  <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="Username" placeholder="Nama Perusahaan" name="nama_perusahaan" required>
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">Daftar</button>
                </div>
                <a href="{{ url('login') }}" class="d-block mt-3 text-muted">Sudah punya Akun? Masuk</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection