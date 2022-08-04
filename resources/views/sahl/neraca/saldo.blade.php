@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/neraca-saldo">neraca saldo</a></li>
    <li class="breadcrumb-item"><a href="/neraca-saldi">Pilih Tahun</a></li>
    <li class="breadcrumb-item"><a href="/neraca-saldo/{{$year}}">{{$year}}</a></li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Neraca Saldo</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>No Akun</th>
                <th>Nama Akun</th>
                <th>Debit</th>
                <th>Kredit</th>             
            </thead>
            <tbody>
              
              <tr>
                <td>1-1100</td>
                <td>Kas</td>
                <td>Rp{{ $Kas->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>1-1200</td>
                <td>Piutang Usaha</td>
                <td>Rp{{ $Piutang_Usaha->total_saldo }}</td>
                <td>-</td>           
              </tr>
              <tr>
                <td>1-1300</td>
                <td>Persediaan</td>
                <td>Rp{{ $Persediaan->total_saldo }}</td>
                <td>-</td>              
              <tr>
                <td>1-1400</td>
                <td>Perlengkapan</td>
                <td>Rp{{ $Perlengkapan->total_saldo }}</td>
                <td>-</td>               
              <tr>
                <td>1-1500</td>
                <td>Sewa Dibayar Di Muka</td>
                <td>Rp{{  $Sewa_Dibayar_Dimuka->total_saldo }}</td>
                <td>-</td>           
              </tr>
              <tr>
                <td>1-1600</td>
                <td>Aset Lancar Lainnya</td>
                <td>Rp{{ $Aset_Lancar_Lainnya->total_saldo }}</td>
                <td>-</td>
               
              </tr>
              <tr>
                <td>1-2100</td>
                <td>Tanah</td>
                <td>Rp{{ $Tanah->total_saldo }}</td>
                <td>-</td>
             
              </tr>
              <tr>
                <td>1-2200</td>
                <td>Bangunan</td>
                <td>Rp{{ $Bangunan->total_saldo }}</td>
                <td>-</td>
            
              </tr>
              <tr>
                <td>1-2210</td>
                <td>Akumulasi Penyusutan Bangunan</td>
                <td>-</td>
                <td>Rp{{ $Akumulasi_Penyusutan_Bangunan->total_Saldo }}</td>
              </tr>   
              <tr>
                <td>1-2300</td>
                <td>Kendaraan</td>
                <td>Rp{{ $Kendaraan->total_saldo }}</td>
                <td>-</td>
              </tr> 
              <tr>
                <td>1-2310</td>
                <td>Akumulasi Penyusutan Kendaraan</td>
                <td>-</td>
                <td>Rp{{ $Akumulasi_Penyusutan_Kendaraan->total_saldo }}</td>
              </tr>
              <tr>
                <td>1-2400</td>
                <td>Peralatan</td>
                <td>Rp{{ $Peralatan->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>1-2410</td>
                <td>Akumulasi Penyusutan Peralatan</td>
                <td>-</td>
                <td>Rp{{ $Akumulasi_Penyusutan_Peralatan->total_saldo }}</td>
              </tr>
              <tr>
                <td>1-2500</td>
                <td>Aset Tetap Lainnya</td>
                <td>Rp{{ $Aset_Tetap_Lainnya->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>1-2600</td>
                <td>Aset Lainnya</td>
                <td>Rp{{ $Aset_Lainnya->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>2-1100</td>
                <td>Utang Usaha</td>
                <td>-</td>
                <td>Rp{{ $Utang_Usaha->total_saldo }}</td>
              </tr>
              <tr>
                <td>2-1200</td>
                <td>Utang Beban</td>
                <td>-</td>
                <td>Rp{{ $Utang_Beban->Total_saldo }}</td>
              </tr>
              <tr>
                <td>2-2100</td>
                <td>Utang Bank</td>
                <td>-</td>
                <td>Rp{{ $Utang_Bank->total_saldo }}</td>
              </tr>
              <tr>
                <td>2-2200</td>
                <td>Utang Lainnya</td>
                <td>-</td>
                <td>Rp{{ $Utang_Lainnya->Total_saldo }}</td>
              </tr>
              <tr>
                <td>3-1100</td>
                <td>Modal</td>
                <td>-</td>
                <td>Rp{{ $Modal->total_saldo }}</td>
              </tr>   
              <tr>
                <td>3-1200</td>
                <td>Prive</td>
                <td>Rp{{ $Prive->total_saldo }}</td>
                <td>-</td>
              </tr>     
              <tr>
                <td>4-1100</td>
                <td>Pendapatan Jasa</td>
                <td>-</td>
                <td>Rp{{ $Pendapatan_Jasa->total_saldo }}</td>
              </tr>
              <tr>
                <td>4-1200</td>
                <td>Pedapatan Sewa</td>
                <td>-</td>
                <td>Rp{{ $Pendapatan_Sewa->total_saldo }}</td>
              </tr>
              <tr>
                <td>4-1300</td>
                <td>Penjualan</td>
                <td>-</td>
                <td>Rp{{ $Penjualan->total_Saldo }}</td>
              </tr>
              <tr>
                <td>4-1400</td>
                <td>Retur Penjualan</td>
                <td>Rp{{ $Retur_Penjualan->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>4-1500</td>
                <td>Potongan Penjualan</td>
                <td>Rp{{ $Potongan_Penjualan->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>4-1600</td>
                <td>Pendapatan Lainnya</td>
                <td>-</td>
                <td>Rp{{ $Pendapatan_Lainnya->total_Saldo }}</td>
              </tr>
              <tr>
                <td>5-1100</td>
                <td>Pembelian</td>
                <td>Rp{{ $Pembelian->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>5-1200</td>
                <td>Retur Pembelian</td>
                <td>-</td>
                <td>Rp{{ $Retur_Pembelian->total_saldo }}</td>
              </tr>
              <tr>
                <td>5-1300</td>
                <td>Potongan Pembelian</td>
                <td>-</td>
                <td>Rp{{ $Potongan_Pembelian->total_saldo }}</td>
              </tr>
              <tr>
                <td>5-1400</td>
                <td>Harga Pokok Penjualan</td>
                <td>Rp{{ $Harga_Pokok_Penjualan->total_saldo }}</td>
                <td>-</td>
              </tr>
              <tr>
                <td>6-1100</td>
                <td>Beban Gaji</td>
                <td>Rp{{ $Beban_Gaji->total_saldo }}</td>
                <td>-</td>
              </tr>    
              <tr>
                <td>6-1200</td>
                <td>Beban Listrik,Air dan Telepon</td>
                <td>Rp{{ $Beban_Listrik_Air_Dan_Telepon->total_saldo }}</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td>6-1300</td>
                <td>Beban Perlengkapan</td>
                <td>Rp{{ $Beban_Perlengkapan->total_saldo  }}</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td>6-1400</td>
                <td>Beban Sewa</td>
                <td>Rp{{ $Beban_Sewa->total_saldo }}</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td>6-1500</td>
                <td>Beban Penyusutan</td>
                <td>Rp{{ $Beban_Penyusutan->total_saldo }}</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td><strong> Total Saldo Debit</strong></td>
                <td>:</td>
                <td>Rp {{ $total_debit }}</td>
              </tr>  
              <tr>
                <td><strong> Total Saldo Kredit</strong></td>
                <td>:</td>
                <td>Rp {{ $total_kredit }}</td>
              </tr>       
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