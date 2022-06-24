@extends('layout.master')

@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Input</a></li>
      <li class="breadcrumb-item active" aria-current="page">Formulir Edit {{$create}}</li>
    </ol>
  </nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Formulir Edit</h6>
        
          <form method="POST" action="/jurnal-umum/{{$transaction->id}}">
            @method('PUT')
            @csrf
                
                
                <div class="mb-3">
                  <label for="exampleInputText1" class="form-label">Tanggal</label>
                  <input type="Date" name="tanggal" class="form-control" id="exampleInputText1" required value="{{$transaction->tanggal}}">
                </div>
                

                <div class="mb-3">
                    <label for="exampleInputNumber1" class="form-label">Jenis Transaksi</label>
                    <select class="form-select" id="option" name="transaksi" required>
                        <option disabled>Pilih Jenis Transaksi</option>
                        @foreach($account as $item)
                        <option value="{{$item->id_transaksi}}" {{ ( $item->id_transaksi == $transaction->id_transaksi ) ? 'selected' : '' }}>{{$item->nama_transaksi}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Nominal</label>
                    <input type="number" name="nominal" class="form-control" id="exampleInputText1" value="{{$transaction->debit}}" placeholder="masukkan nominal" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="exampleFormControlTextarea1" value="{{$transaction->keterangan}}" rows="5"></textarea>
                </div>
                

                <button class="btn btn-primary" type="submit">Tambah</button>
            </form>
        </div>
      </div>
    </div>
</div>

@endsection