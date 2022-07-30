@extends('layout.master')

@section('content')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/perubahan-modal">Laba Rugi</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$year}}</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">{{$company}}</h5>
        <h6 class="card-title text-center">Laporan Perubahan Modal</h6>
        <p class="text-muted text-center mb-3">Desember {{$year}}</p>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">

            <tbody>
              <tr>
                <td>
                  Modal Awal
                </td>
                <td>
                  
                </td>
                <td>
                Rp{{$modal_awal->total_saldo}}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Laba/Rugi
                </td>
                <td>
                  Rp{{$laba_rugi->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Prive
                </td>
                <td>
                Rp{{$prive->total_saldo}}
                </td>
                <td>
                  
                </td>
                
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Penambahan/Pengurangan Modal
                </td>
                <td>
                  
                </td>
                <td>
                Rp{{$penambahan_pengurangan_modal}}
                </td>
                
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Modal Akhir
                </td>
                <td>
                  
                </td>
                <td>
                 <strong>Rp{{$modal_akhir}}</strong>
                </td>
                
              </tr>
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection