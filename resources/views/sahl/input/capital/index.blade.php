@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')

@if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <!-- <li class="breadcrumb-item"><a href="#">Jurnal</a></li> -->
    <li class="breadcrumb-item active" aria-current="page">Modal</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="card-title d-flex justify-content-between"><h6>Tabel Modal</h6><span><a href="/modal/create" class="btn btn-inverse-primary" >Tambah Modal</a></span></div>
        
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Nama Modal</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($capital as $item)
              <tr>
                <td>{{$item->date}}</td>
                <td>
                  {{$item->nama_modal}}
                </td>
                <td>
                  @currency($item->nominal)
                </td>
                <td>
                  {{$item->keterangan}}
                </td>
                <td>
                  <div class="row">
                    <div class="col-sm-2">
                      <a href="/modal/{{$item->id}}/edit" class="btn btn-primary btn-icon">
                        <i data-feather="edit"></i>
                      </a>
                    </div>
                    <div class="col-sm">
                      <form action="/modal/{{$item->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-icon" onclick="return confirm('Apakah yakin ingin dihapus?')">
                          <i data-feather="trash-2"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
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