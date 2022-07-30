@extends('layout.master')

@section('content')


@if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/utang">Tabel Utang</a></li>
      <li class="breadcrumb-item active" aria-current="page">Formulir Edit Utang</li>
    </ol>
  </nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Formulir Edit</h6>
        
          <form method="POST" action="/utang/{{$debt->id}}">
            @method('PUT')
            @csrf

                <div class="mb-3">
                    <label for="exampleInputNumber1" class="form-label">Jenis Utang</label>
                    <select class="form-select" id="option" name="nama_utang" required>
                        <option selected disabled>Pilih Jenis Utang</option>
                        @foreach($account as $item)
                        <option value="{{$item->nama_akun}}" {{ ( $item->nama_akun == $debt->nama_utang ) ? 'selected' : '' }}>{{$item->nama_akun}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Nominal</label>
                    <input type="number" name="nominal" class="form-control" id="exampleInputText1" placeholder="masukkan nominal" value="{{$debt->nominal}}" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" rows="5">{{$debt->keterangan}}</textarea>
                </div>
                
                <button class="btn btn-primary" type="submit">Ubah</button>
            </form>
        </div>
      </div>
    </div>
</div>

@endsection