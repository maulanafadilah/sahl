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
                <td>@currency($Kas->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>1-1200</td>
                <td>Piutang Usaha</td>
                <td>@currency($Piutang_Usaha->total_saldo)</td>
                <td>-</td>           
              </tr>
              <tr>
                <td>1-1300</td>
                <td>Persediaan</td>
                <td>@currency($Persediaan->total_saldo)</td>
                <td>-</td>              
              <tr>
                <td>1-1400</td>
                <td>Perlengkapan</td>
                <td>@currency($Perlengkapan->total_saldo)</td>
                <td>-</td>               
              <tr>
                <td>1-1500</td>
                <td>Sewa Dibayar Di Muka</td>
                <td>@currency( $Sewa_Dibayar_Dimuka->total_saldo)</td>
                <td>-</td>           
              </tr>
              <tr>
                <td>1-1600</td>
                <td>Aset Lancar Lainnya</td>
                <td>@currency($Aset_Lancar_Lainnya->total_saldo)</td>
                <td>-</td>
               
              </tr>
              <tr>
                <td>1-2100</td>
                <td>Tanah</td>
                <td>@currency($Tanah->total_saldo)</td>
                <td>-</td>
             
              </tr>
              <tr>
                <td>1-2200</td>
                <td>Bangunan</td>
                <td>@currency($Bangunan->total_saldo)</td>
                <td>-</td>
            
              </tr>
              <tr>
                <td>1-2210</td>
                <td>Akumulasi Penyusutan Bangunan</td>
                <td>-</td>
                <td>@currency($Akumulasi_Penyusutan_Bangunan->total_Saldo)</td>
              </tr>   
              <tr>
                <td>1-2300</td>
                <td>Kendaraan</td>
                <td>@currency($Kendaraan->total_saldo)</td>
                <td>-</td>
              </tr> 
              <tr>
                <td>1-2310</td>
                <td>Akumulasi Penyusutan Kendaraan</td>
                <td>-</td>
                <td>@currency($Akumulasi_Penyusutan_Kendaraan->total_saldo)</td>
              </tr>
              <tr>
                <td>1-2400</td>
                <td>Peralatan</td>
                <td>@currency($Peralatan->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>1-2410</td>
                <td>Akumulasi Penyusutan Peralatan</td>
                <td>-</td>
                <td>@currency($Akumulasi_Penyusutan_Peralatan->total_saldo)</td>
              </tr>
              <tr>
                <td>1-2500</td>
                <td>Aset Tetap Lainnya</td>
                <td>@currency($Aset_Tetap_Lainnya->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>1-2600</td>
                <td>Aset Lainnya</td>
                <td>@currency($Aset_Lainnya->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>2-1100</td>
                <td>Utang Usaha</td>
                <td>-</td>
                <td>@currency($Utang_Usaha->total_saldo)</td>
              </tr>
              <tr>
                <td>2-1200</td>
                <td>Utang Beban</td>
                <td>-</td>
                <td>@currency($Utang_Beban->Total_saldo)</td>
              </tr>
              <tr>
                <td>2-2100</td>
                <td>Utang Bank</td>
                <td>-</td>
                <td>@currency($Utang_Bank->total_saldo)</td>
              </tr>
              <tr>
                <td>2-2200</td>
                <td>Utang Lainnya</td>
                <td>-</td>
                <td>@currency($Utang_Lainnya->Total_saldo)</td>
              </tr>
              <tr>
                <td>3-1100</td>
                <td>Modal</td>
                <td>-</td>
                <td>@currency($Modal->total_saldo)</td>
              </tr>   
              <tr>
                <td>3-1200</td>
                <td>Prive</td>
                <td>@currency($Prive->total_saldo)</td>
                <td>-</td>
              </tr>     
              <tr>
                <td>4-1100</td>
                <td>Pendapatan Jasa</td>
                <td>-</td>
                <td>@currency($Pendapatan_Jasa->total_saldo)</td>
              </tr>
              <tr>
                <td>4-1200</td>
                <td>Pedapatan Sewa</td>
                <td>-</td>
                <td>@currency($Pendapatan_Sewa->total_saldo)</td>
              </tr>
              <tr>
                <td>4-1300</td>
                <td>Penjualan</td>
                <td>-</td>
                <td>@currency($Penjualan->total_Saldo)</td>
              </tr>
              <tr>
                <td>4-1400</td>
                <td>Retur Penjualan</td>
                <td>@currency($Retur_Penjualan->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>4-1500</td>
                <td>Potongan Penjualan</td>
                <td>@currency($Potongan_Penjualan->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>4-1600</td>
                <td>Pendapatan Lainnya</td>
                <td>-</td>
                <td>@currency($Pendapatan_Lainnya->total_Saldo)</td>
              </tr>
              <tr>
                <td>5-1100</td>
                <td>Pembelian</td>
                <td>@currency($Pembelian->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>5-1200</td>
                <td>Retur Pembelian</td>
                <td>-</td>
                <td>@currency($Retur_Pembelian->total_saldo)</td>
              </tr>
              <tr>
                <td>5-1300</td>
                <td>Potongan Pembelian</td>
                <td>-</td>
                <td>@currency($Potongan_Pembelian->total_saldo)</td>
              </tr>
              <tr>
                <td>5-1400</td>
                <td>Harga Pokok Penjualan</td>
                <td>@currency($Harga_Pokok_Penjualan->total_saldo)</td>
                <td>-</td>
              </tr>
              <tr>
                <td>6-1100</td>
                <td>Beban Gaji</td>
                <td>@currency($Beban_Gaji->total_saldo)</td>
                <td>-</td>
              </tr>    
              <tr>
                <td>6-1200</td>
                <td>Beban Listrik,Air dan Telepon</td>
                <td>@currency($Beban_Listrik_Air_Dan_Telepon->total_saldo)</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td>6-1300</td>
                <td>Beban Perlengkapan</td>
                <td>@currency($Beban_Perlengkapan->total_saldo )</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td>6-1400</td>
                <td>Beban Sewa</td>
                <td>@currency($Beban_Sewa->total_saldo)</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td>6-1500</td>
                <td>Beban Penyusutan</td>
                <td>@currency($Beban_Penyusutan->total_saldo)</td>
                <td>-</td>  
              </tr> 
              <tr>
                <td><strong> Total Saldo Debit</strong></td>
                <td>:</td>
                <td>@currency($total_debit)</td>
              </tr>  
              <tr>
                <td><strong> Total Saldo Kredit</strong></td>
                <td>:</td>
                <td>@currency($total_kredit)</td>
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