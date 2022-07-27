@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/buku-besar">Buku Besar</a></li>
    <li class="breadcrumb-item"><a href="/buku-besar">Pilih Tahun</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$year}}</li>
  </ol>
</nav>
<h1 class="page-title text-center">{{auth()->user()->nama_perusahaan}}</h1>
<p class="lead text-center mb-4">Buku Besar {{$year}}</p>

@foreach($account as $item)
<div class="row mt-2">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Nama Akun: {{$item->nama_akun}}</h6>
        <p class="text-muted mb-3">Nomor Akun: {{$item->nomor_akun}}</p>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th rowspan="2">
                  Tanggal
                </th>
                <th rowspan="2">
                  Keterangan
                </th>
                <th rowspan="2">
                  Debit
                </th>
                <th rowspan="2">
                  Kredit
                </th>
                <th colspan="2">
                  Saldo
                </th>
              </tr>
              <tr>
                <th scope="col">Debit</th>
                <th scope="col">Kredit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  1
                </td>
                <td>
                  Cedric Kelly
                </td>
                <td>
                  <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </td>
                <td>
                  $206,850
                </td>
                <td>
                  June 21, 2010
                </td>
                <td>
                  June 21, 2010
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection