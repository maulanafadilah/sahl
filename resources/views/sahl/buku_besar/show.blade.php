@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/buku-besar">Buku Besar</a></li>
    <li class="breadcrumb-item"><a href="/buku-besar">Pilih Tahun</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$year}}</li>
  </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Pilih Tahun</h6>
              @foreach($account as $item)
              <ul class="list-group">
                <a href="{{$year}}/accounts/{{$item->nama_akun}}"><li class="list-group-item d-flex justify-content-between align-items-center">{{$item->nomor_akun}} &nbsp; | &nbsp; {{$item->nama_akun}} <span><button class="btn btn-primary">Lihat</button></span></li></a>
              </ul>
              @endforeach
          </div>
      </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush