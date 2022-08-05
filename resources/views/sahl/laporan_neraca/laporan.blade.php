@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/laporan_neraca-laporan">Laporan Neraca</a></li>
    <li class="breadcrumb-item"><a href="/laporan_neraca-laporan">Pilih Tahun</a></li>
    <li class="breadcrumb-item"><a href="/laporan_neraca-laporan/{{$tanggal}}">{{$tanggal}}</a></li>
  </ol>
</nav>
        <div class="row">
          <div class=" grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><center>{{ auth()->user()->nama_perusahaan }}</center></h4>
                <p class="text-muted"><center>Laporan Neraca</center></p>        
              </div>
            </div>
          </div>
        </div>
    
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Aktiva</h6>
                  <p class="text-muted mb-3">Aset Lancar</p>
                  <div class="table-responsive" >
                      <table class="table table-bordered">  
                        <tbody>                  
                          <tr>
                            <td><strong>Kas</strong></td>
                            <td>Rp {{ $kas->total_saldo }}</td>
                          </tr>                                                                                                       
                          <tr>
                            <td><strong> Piutang Usaha</strong></td>
                            <td>Rp {{ $piutang_usaha->total_saldo }}</td>
                          </tr>                     
               
                          <tr>
                            <td><strong> persediaan </strong></td>
                            <td>Rp {{ $persediaan->total_saldo }}</td>
                          </tr>                     
                           <tr>
                                <td><strong>Perlengkapan</strong></td>
                                <td>Rp {{ $perlengkapan->total_saldo }}</td>
                              </tr>                                 
                          <tr>
                            <td><strong>Sewa Dibayar Di Muka</strong></td>
                            <td>Rp {{ $Sewa_Dibayar_Di_Muka->total_saldo }}</td>
                          </tr>                                             
                          <tr>
                            <td><strong>Aset Lancar Lainnya</strong></td>
                            <td>Rp {{ $Aset_Lancar_Lainnya->total_saldo }}</td>
                          </tr>
                             <tr>
                            <td><strong>Total Aset Lancar</strong></td>
                            <td>Rp {{ $total_asset_lancar }}</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Pasiva</h6>
                  <p class="text-muted mb-3">Utang Lancar</p>
                  <div class="table-responsive">
                      <table class="table table-hover table-bordered">

                        <tbody>                        
                              <tr>
                                <td><strong>Utang Usaha</strong></td>
                                <td>Rp {{ $Utang_usaha->total_saldo }}</td>
                              </tr>                     
                              <tr>
                                <td><strong>Utang Beban</strong></td>
                                <td>Rp {{ $Utang_beban->total_Saldo }}</td>
                              </tr>
                              <tr>                 
                                <td><strong>Total Utang Lancar</strong></td>
                                <td>Rp {{ $total_utang_lancar }}</td>
                              </tr>                                                              
                        </tbody>
                      </table>
                        <br>
                          <p class="text-muted mb-3"><strong>Utang Jangka Panjang</strong></p>
                            <table class="table table-hover table-bordered">
                              <tr>
                                <td><strong>Utang Bank</strong></td>
                                <td>Rp {{ $Utang_Bank->total_saldo }}</td>
                              </tr>
                              <tr>
                                <td><strong>Total Utang Jangka Panjang</strong></td>
                                <td>Rp {{$total_utang_jangka_panjang}}</td>
                              </tr>

                      </table>
                  </div>
                </div>
              </div>
            </div>
            
        </div>

          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="text-muted mb-3">Aset Tetap</p>
                  <div class="table-responsive">
                      <table class="table table-bordered">                  
                        <tbody>                    
                              <tr>
                                <td><strong>Tanah</strong></td>
                                <td>Rp {{ $Tanah->total_saldo }}</td>
                              </tr>                     
                              <tr>
                                <td><strong>Bangunan</strong></td>
                                <td>Rp {{ $Bangunan->total_Saldo }}</td>
                              </tr>                    
                              <tr>
                                <td><strong>Akumulasi Penyusutan Bangunan</strong></td>
                                <td>Rp {{ $Akumulasi_Penyusutan_Bangunan->total_saldo }}</td>
                              </tr>                                                     
                              <tr>
                                <td><strong>Kendaraan</strong></td>
                                <td>Rp {{ $Kendaraan->total_saldo }}</td>
                              </tr>                     
                          <tr>
                            <td><strong>Akumulasi Penysusutan kendaraan</strong></td>
                          <td>Rp {{ $Akumulasi_Penyusutan_Kendaraan->total_saldo }}</td>
                          </tr>                                                
                          <tr>
                            <td><strong>Peralatan</strong></td>
                            <td>Rp {{ $Peralatan->total_saldo }}</td>
                          </tr>                  
                      <tr>
                    <td><strong>Akumulasi Penyusutan Peralatan</strong></td>
                      <td>Rp {{ $Akumulasi_Penyusutan_Peralatan->total_saldo }}</td>
                      </tr>                                           
                      <tr>
                        <td><strong>Aset Tetap Lainnya</strong></td>
                        <td>Rp {{ $Aset_Tetap_Lainnya->total_saldo }}</td>
                      </tr>            
                      <tr>
                        <td>Aset Lainnya</td>
                        <td>Rp {{ $Aset_Lainnya->total_Saldo }}</td>
                      </tr>               
                  <tr>
                      <td><strong>Total Aset Tetap</strong></td>
                      <td>Rp {{ $total_aset_tetap }}</td>
                  </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Modal</h6>                  
                  <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>                          
                          <tr>
                            <td><strong>Modal Akhir</strong></td>
                            <td>Rp {{ $Modal->total_saldo }}</td>
                          </tr>
                            </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Total</h6>
                  <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>                          
                          <tr>
                            <td><strong>TOTAL ASSET</strong></td>
                            <td>Rp {{ $total_asset }}</td>
                          </tr>
                          <tr>
                            <td><strong>TOTAL UTANG</strong></td>
                            <td>Rp {{ $total_utang }}</td>
                          </tr>                          
                          <tr>
                            <td><strong>TOTAL UTANG DAN MODAL</strong></td>
                            <td>Rp {{  $total_utang_dan_modal }}</td>
                          </tr>
                        </tbody>                       
                      </table>
                      <br>
                      <center>
                        <a href="{{ url('/cetakpdf') }}" class="btn btn-primary">cetak pdf</a>
                      </center>
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