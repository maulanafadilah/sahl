@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')

@if(session()->has('success'))
        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif

        <div class="row">
          <div class=" grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><center>{{ auth()->user()->nama_perusahaan }}</center></h4>
                <p class="text-muted"><center>Laporan Neraca</center></p>
                <p class="text-muted"></p>

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
                          @foreach($kas as $item)
                          <tr>
                            <td><strong>Kas</strong></td>
                            <td>Rp {{ $item ->nominal }}</td>
                          </tr>
                          @endforeach
                          @foreach ($piutang_usaha as $item)                                                        
                          <tr>
                            <td><strong> Piutang Usaha</strong></td>
                            <td>Rp {{ $item->nominal }}</td>
                          </tr>
                          @endforeach
                          @foreach ($persediaan as $item)      
                          <tr>
                            <td><strong> persediaan </strong></td>
                            <td>Rp {{ $item->nominal }}</twd>
                          </tr>
                          @endforeach
                          @foreach ($perlengkapan as $item)
                              <tr>
                                <td><strong>Perlengkapan</strong></td>
                                <td>Rp {{ $item->nominal }}</td>
                              </tr>
                          @endforeach
                          @foreach ($Sewa_Dibayar_Di_Muka as $item)
                          <tr>
                            <td><strong>Sewa Dibayar Di Muka</strong></td>
                            <td>Rp {{ $item->nominal }}</td>
                          </tr>          
                          @endforeach
                          @foreach ($Aset_Lancar_Lainnya as $item)
                          <tr>
                            <td><strong>Aset Lancar Lainnya</strong></td>
                            <td>Rp{{ $item->nominal }}</td>
                          </tr>
                              
                          @endforeach
                          <tr>
                            <td><strong>Total Aset Lancar</strong></td>
                            <td>Rp</td>
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
                          @foreach ($Utang_usaha as $item)
                              <tr>
                                <td><strong>Utang Usaha</strong></td>
                                <td>Rp {{ $item->nominal }}</td>
                              </tr>
                          @endforeach
                          @foreach ($Utang_beban as $item)
                              <tr>
                                <td><strong>Utang Beban</strong></td>
                                <td>Rp {{ $item->nominal }}</td>
                              </tr>
                              <tr>
                                <td><strong>Total Utang Lancar</strong></td>
                                <td>Rp </td>
                              </tr>
                              
                          @endforeach
                        </tbody>
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
                          @foreach ($Tanah as $item)
                              <tr>
                                <td><strong>Tanah</strong></td>
                                <td>Rp {{ $item->nominal }}</td>
                              </tr>
                          @endforeach    
                          @foreach ($Bangunan as $item)
                              <tr>
                                <td><strong>Bangunan</strong></td>
                                <td>Rp {{ $item->nominal }}</td>
                              </tr>
                          @endforeach                
                          @foreach ($Akumulasi_Penyusutan_Bangunan as $item)
                              <tr>
                                <td><strong>Akumulasi Penyusunan Bangunan</strong></td>
                                <td>Rp{{ $item->nomial }}</td>
                              </tr>                              
                          @endforeach
                          @foreach ($Kendaraan as $item)
                              <tr>
                                <td><strong>Kendaraan</strong></td>
                                <td>Rp {{ $item->nominal }}</td>
                              </tr>
                          @endforeach  
                          @foreach ($Akumulasi_Penyusutan_Kendaraan as $item)
                          <tr>
                            <td><strong>Akumulasi Penyusunan Kendaraan</strong></td>
                            <td>Rp{{ $item->nomial }}</td>
                          </tr>                              
                      @endforeach           
                      @foreach ($Peralatan as $item)
                          <tr>
                            <td><strong>Peralatan</strong></td>
                            <td>Rp {{ $item->nominal }}</td>
                          </tr>
                      @endforeach               
                      @foreach ($Akumulasi_Penyusutan_Peralatan as $item)
                      <tr>
                        <td><strong>Akumulasi Penyusunan Peralatan</strong></td>
                        <td>Rp {{ $item->nomial }}</td>
                      </tr>                              
                  @endforeach
                  @foreach ($Aset_Tetap_Lainnya as $item)
                      <tr>
                        <td><strong>Aset Tetap Lainnya</strong></td>
                        <td>Rp {{ $item->nominal }}</td>
                      </tr>
                  @endforeach
                  @foreach ($Aset_Lainnya as $item)
                  <tr>
                    <td><strong>Aset tetap lainnya</strong></td>
                    <td>Rp {{ $item->nominal }}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td><strong>total asset Tetap</strong></td>
                    <td>Rp</td>
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
                  <p class="text-muted mb-3">Utang Jangka Panjang</p>
                  <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>
                          @foreach ($Utang_Bank as $item)
                          <tr>
                            <td><strong>Utang Bank</strong></td>
                            <td>Rp {{ $item->nominal }}</td>
                          </tr>
                              
                          @endforeach
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
                          @foreach ($Utang_Bank as $item)
                          <tr>
                            <td><strong>TOTAL ASSET</strong></td>
                            <td>Rp {{ $item->nominal }}</td>
                          </tr>
                              
                          @endforeach
                          <tr>
                            <td><strong>TOTAL UTANG DAN MODAL</strong></td>
                            <td>Rp </td>
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