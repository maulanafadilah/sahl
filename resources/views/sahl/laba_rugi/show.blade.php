@extends('layout.master')

@section('content')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/laba-rugi">Laba Rugi</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$year}}</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">{{$company}}</h5>
        <h6 class="card-title text-center">Laporan Laba Rugi</h6>
        <p class="text-muted text-center mb-3">Desember {{$year}}</p>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <!-- Penjualan -->
            <thead>
              <tr>
                <th>
                 <strong>Penjualan:</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  
                </td>
                <td>
                  
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Penjualan
                </td>
                <td>
                  
                </td>
                <td>
                  Rp{{$penjualan->total_saldo}}
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Retur Penjualan
                </td>
                <td>
                  
                </td>
                <td>
                Rp{{$retur_penjualan->total_saldo}}
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Potongan Penjualan
                </td>
                <td>
                  
                </td>
                <td>
                  Rp{{$potongan_penjualan->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th>
                 <strong>Penjualan Bersih</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  
                </td>
                <td>
                  Rp{{$penjualan_bersih}}
                </td>
              </tr>
            </thead>

            <!-- Persediaan Awal -->
            <tbody>
              <tr>
                <td>
                  Persediaan Awal
                </td>
                <td>
                  
                </td>
                <td>
                  
                </td>
                <td>
                  Rp{{$persediaan_awal->total_saldo}}
                </td>
              </tr>
            </tbody>

            <!-- Pembelian -->
            <thead>
              <tr>
                <th>
                 <strong>Pembelian:</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  
                </td>
                <td>
                  
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Pembelian
                </td>
                <td>
                  Rp{{$pembelian->total_saldo}}
                </td>
                <td>
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Retur Pembelian
                </td>
                <td>
                  Rp{{$pembelian->total_saldo}}
                </td>
                <td>
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Potongan Pembelian
                </td>
                <td>
                  Rp{{$pembelian->total_saldo}}
                </td>
                <td>
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th>
                 <strong>Pembelian Bersih</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  Rp{{$pembelian_bersih}}
                </td>
                <td>
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Persediaan Tersedia untuk Dijual
                </td>
                <td>
                </td>
                <td>
                  Rp{{$persediaan_dijual}}
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Persediaan Akhir
                </td>
                <td>
                </td>
                <td>
                  Rp{{$persediaan_akhir->nominal}}
                </td>
                <td>
                  
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Harga Pokok Penjualan
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                  Rp{{$pokok_penjualan}}
                  
                </td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th>
                 <strong>Laba Kotor</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  </td>
                  <td>
                  Rp{{$laba_kotor}}
                </td>
              </tr>
            </thead>
            <thead>
              <tr>
                <th>
                 <strong>Pendapatan:</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  </td>
                  <td>
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Pendapatan Jasa
                </td>
                <td>
                </td>
                <td>
                  Rp{{$pendapatan_jasa->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Pendapatan Sewa
                </td>
                <td>
                </td>
                <td>
                Rp{{$pendapatan_sewa->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Pendapatan Lainnya
                </td>
                <td>
                </td>
                <td>
                Rp{{$pendapatan_lain->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th>
                 <strong>Total Pendapatan</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  </td>
                  <td>
                  Rp{{$total_pendapatan}}
                </td>
              </tr>
            </thead>
            <thead>
              <tr>
                <th>
                 <strong>Beban</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  </td>
                  <td>
                  
                </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Beban Gaji
                </td>
                <td>
                </td>
                <td>
                Rp{{$beban_gaji->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Beban Listrik, Air, dan Telepon
                </td>
                <td>
                </td>
                <td>
                Rp{{$beban_listrik->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Beban Perlengkapan
                </td>
                <td>
                </td>
                <td>
                Rp{{$beban_perlengkapan->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Beban Sewa
                </td>
                <td>
                </td>
                <td>
                Rp{{$beban_sewa->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td>
                  Beban Penyusutan
                </td>
                <td>
                </td>
                <td>
                Rp{{$beban_penyusutan->total_saldo}}
                </td>
                <td>
                </td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th>
                 <strong>Total Beban</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  </td>
                  <td>
                  Rp{{$total_beban}}
                </td>
              </tr>
            </thead>
            <thead>
              <tr>
                <th>
                 <strong>Laba/Rugi Bersih</strong>
                </th>
                <td>
                  
                </td>
                <td>
                  </td>
                  <td>
                  Rp{{$laba_rugi_bersih}}
                </td>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection