@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/buku-besar">Buku Besar</a></li>
    <li class="breadcrumb-item"><a href="/buku-besar">Pilih Tahun</a></li>
    <li class="breadcrumb-item"><a href="/buku-besar/{{$year}}">{{$year}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$acc}}</li>
  </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">{{$acc}}</h6>
                        <div class="table-responsive pt-3">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th rowspan="2">
                                  Tanggal
                                </th>
                                <th rowspan="2">
                                  Keterangan
                                </th>
                                <th rowspan="2">
                                  Debit
                                </th>
                                <th rowspan="2">
                                  Kredit
                                </th>
                                <th colspan="2" class="text-center">
                                  Saldo
                                </th>
                              </tr>
                              <tr>
                                <th scope="col">Debit</th>
                                <th scope="col">Kredit</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  1 Des
                                </td>
                                <td>
                                  Saldo Awal
                                </td>
                                <td>
                                  
                                </td>
                                <td>
                                  
                                </td>
                                <td>
                                  @if($saldo_awal_debit->nominal_debit != null)
                                  Rp{{$saldo_awal_debit->nominal_debit}}
                                  @else
                                  -
                                  @endif
                                </td>
                                <td>
                                  @if($saldo_awal_kredit->nominal_kredit != null)
                                  Rp{{$saldo_awal_kredit->nominal_kredit}}
                                  @else
                                  -
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  31 Des
                                </td>
                                <td>
                                  Posting
                                </td>
                                <td>
                                  Rp{{$posting_debit->pdebit}}
                                </td>
                                <td>
                                  Rp{{$posting_kredit->pkredit}}
                                </td>
                                <td>
                                  @if($total_saldo_debit == true)
                                  Rp{{$total_saldo_debit}}
                                  @else
                                  -
                                  @endif
                                </td>
                                <td>
                                  @if($total_saldo_kredit == true)
                                  Rp{{$total_saldo_kredit}}
                                  @else
                                  -
                                  @endif
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
          </div>
      </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
