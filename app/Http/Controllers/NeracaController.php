<?php

namespace App\Http\Controllers;

use auth;
use App\Debt;
use App\Asset;
use App\Account;
use App\General_Journal;
use App\Superbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeracaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $id_pengguna = auth()->user()->id;
            $year = Superbook::select('tahun')->where('id_pengguna', $id_pengguna)->groupBy('tahun')->get();
            
            // return $year;
            return view('sahl.neraca.index', compact('year'));
        
        }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_pengguna = auth() ->user()->id;
         $year = $id;

         //debit
         
         $Kas                               = Superbook::select('total_saldo')->where('nama_akun', 'Kas')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Piutang_Usaha                     = Superbook::select('total_saldo')->where('nama_akun', 'Piutang Usaha')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Persediaan                        = Superbook::select('total_saldo')->where('nama_akun', 'Persediaan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Perlengkapan                      = Superbook::select('total_saldo')->where('nama_akun', 'Perlengkapan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Sewa_Dibayar_Dimuka               = Superbook::select('total_saldo')->where('nama_akun', 'Sewa Dibayar Di Muka')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Aset_Lancar_Lainnya               = Superbook::select('total_saldo')->where('nama_akun', 'Aset Lancar Lainnya')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Tanah                             = Superbook::select('total_saldo')->where('nama_akun', 'Tanah')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Bangunan                          = Superbook::select('total_saldo')->where('nama_akun', 'Bangunan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Kendaraan                         = Superbook::select('total_saldo')->where('nama_akun', 'Kendaraan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Peralatan                         = Superbook::select('total_saldo')->where('nama_akun', 'Peralatan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Aset_Tetap_Lainnya                = Superbook::select('total_saldo')->where('nama_akun', 'Aset Tetap Lainnya')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Aset_Lainnya                      = Superbook::select('total_saldo')->where('nama_akun', 'Aset Lainnya')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Prive                             = Superbook::select('total_saldo')->where('nama_akun', 'Prive')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Retur_Penjualan                   = Superbook::select('total_saldo')->where('nama_akun', 'Retur Penjualan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Potongan_Penjualan                = Superbook::select('total_saldo')->where('nama_akun', 'Potongan Penjualan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Pembelian                         = Superbook::select('total_saldo')->where('nama_akun', 'Pembelian')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Harga_Pokok_Penjualan             = Superbook::select('total_saldo')->where('nama_akun', 'Harga Pokok Penjualan')->where('tahun',$year)->where('id_pengguna',$id_pengguna)->first();
         $Beban_Gaji                        = Superbook::select('total_saldo')->where('nama_akun', 'Beban Gaji')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Beban_Listrik_Air_Dan_Telepon     = Superbook::select('total_saldo')->where('nama_akun', 'Beban Listrik, Air Dan Telepon')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Beban_Perlengkapan                = Superbook::select('total_saldo')->where('nama_akun', 'Beban Perlengkapan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Beban_Sewa                        = Superbook::select('total_saldo')->where('nama_akun', 'Beban Sewa')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Beban_Penyusutan                  = Superbook::select('total_saldo')->where('nama_akun', 'Beban Penyusutan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();

         
         //kredit
         $Modal                             = Superbook::select('total_saldo')->where('nama_akun', 'Modal')->where('tahun',$year)->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Akumulasi_Penyusutan_Bangunan     = Superbook::select('total_saldo')->where('nama_akun', 'Akumulasi Penyusutan Bangunan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Akumulasi_Penyusutan_Kendaraan    = Superbook::select('total_saldo')->where('nama_akun', 'Akumulasi Penyusutan Kendaraan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Akumulasi_Penyusutan_Peralatan    = Superbook::select('total_saldo')->where('nama_akun', 'Akumulasi Penyusutan Peralatan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Utang_Usaha                       = Superbook::select('total_saldo')->where('nama_akun', 'Utang Usaha')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Utang_Beban                       = Superbook::select('total_saldo')->where('nama_akun', 'Utang Beban')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Utang_Bank                        = Superbook::select('total_saldo')->where('nama_akun', 'Utang Bank')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Utang_Lainnya                     = Superbook::select('total_saldo')->where('nama_akun', 'Utang Lainnya')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Pendapatan_Jasa                   = Superbook::select('total_saldo')->where('nama_akun', 'Pendapatan Jasa')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Pendapatan_Sewa                   = Superbook::select('total_saldo')->where('nama_akun', 'Pendapatan Sewa')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Pendapatan_Lainnya                = Superbook::select('total_Saldo')->where('nama_akun', 'Pendapatan_lainnya')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Penjualan                         = Superbook::select('total_saldo')->where('nama_akun', 'Penjualan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Potongan_Penjualan                = Superbook::select('total_saldo')->where('nama_akun', 'Potongan Penjualan')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Pendapatan_Lainnya                = Superbook::select('total_saldo')->where('nama_akun', 'Pendapatan Lainnya')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Retur_Pembelian                   = Superbook::select('total_saldo')->where('nama_akun', 'Retur Pembelian')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         $Potongan_Pembelian                = Superbook::select('total_saldo')->where('nama_akun', 'Potongan Pembelian')->where('tahun',$year)->where('id_pengguna', $id_pengguna)->first();
         
         $total_debit = $Kas->total_saldo + $Piutang_Usaha->total_saldo + $Persediaan->total_saldo + $Perlengkapan->total_saldo + $Sewa_Dibayar_Dimuka->total_saldo +
                        $Aset_Lancar_Lainnya->total_saldo + $Tanah->total_saldo + $Bangunan->total_saldo + $Kendaraan->total_saldo + $Peralatan->total_saldo + $Aset_Tetap_Lainnya->total_saldo + $Aset_Lainnya->total_saldo + $Prive->total_saldo +
                        $Retur_Penjualan->total_saldo + $Potongan_Penjualan->total_saldo + $Pembelian->total_saldo + $Harga_Pokok_Penjualan->total_saldo + $Beban_Gaji->total_saldo + $Beban_Listrik_Air_Dan_Telepon->total_saldo + $Beban_Perlengkapan->total_saldo + 
                        $Beban_Sewa->total_saldo + $Beban_Penyusutan->total_saldo;

        $total_kredit = $Modal->total_saldo + $Akumulasi_Penyusutan_Bangunan->total_saldo + $Akumulasi_Penyusutan_Kendaraan->total_saldo + $Akumulasi_Penyusutan_Peralatan->total_saldo + $Utang_Usaha->total_saldo + $Utang_Beban->total_saldo + $Utang_Bank->total_saldo + $Utang_Lainnya->total_saldo + $Pendapatan_Jasa->total_saldo + $Pendapatan_Sewa->total_saldo + $Pendapatan_Lainnya->total_saldo + $Penjualan->total_saldo + $Potongan_Penjualan->total_saldo + $Pendapatan_Lainnya->total_saldo + $Retur_Pembelian->total_saldo + $Potongan_Pembelian->total_saldo;
         //return $total_persediaan;
        return view('sahl.neraca.saldo',compact('Kas','Piutang_Usaha','Persediaan','Perlengkapan','Sewa_Dibayar_Dimuka','Aset_Lancar_Lainnya','Tanah','Bangunan','Kendaraan','Peralatan','Aset_Tetap_Lainnya','Aset_Lainnya','Prive','Retur_Penjualan','Potongan_Penjualan','Pembelian','Harga_Pokok_Penjualan','Beban_Gaji','Beban_Listrik_Air_Dan_Telepon','Beban_Perlengkapan','Beban_Sewa','Beban_Penyusutan',
                                                'Akumulasi_Penyusutan_Bangunan','Akumulasi_Penyusutan_Kendaraan','Akumulasi_Penyusutan_Peralatan','Pendapatan_Lainnya','Utang_Usaha','Utang_Beban','Utang_Bank','Utang_Lainnya','Pendapatan_Jasa','Pendapatan_Sewa','Penjualan','Potongan_Penjualan','Modal','Retur_Pembelian','Potongan_Pembelian'
                                                ,'total_debit','total_kredit','year'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
