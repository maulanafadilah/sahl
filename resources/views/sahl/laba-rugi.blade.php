@extends('layout.master')

@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Bordered table</h6>
        <p class="text-muted mb-3">Add class <code>.table-bordered</code></p>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">

            <thead>
              <tr>
                <th>
                  Penjualan:
                </th>
                <td>
                  
                </td>
                <td>
                  
                </td>
                <td>
                  
                </td>
              </tr>
            </thead>
            
            @foreach($penjualan as $item)
            <tbody>
              <tr>
                <td>
                  {{$item->nama_akun}}
                </td>
                <td>
                  
                </td>
                <td>
                  
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            @endforeach

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection