<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Superbook;

class LaporanNeracaController extends Controller
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
            return view('sahl.laporan_neraca.index', compact('year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tanggal                         = $id;
        $id_pengguna                     = Auth()->user()->id;
    
        //asset Lancar

        $kas                             = Superbook::select('total_saldo')->where('nama_akun', 'Kas')->where('id_pengguna',$id_pengguna)->first ();
        $piutang_usaha                   = Superbook::select('total_saldo')->where('nama_akun', 'Piutang usaha')->where('id_pengguna',$id_pengguna)->first();
        $persediaan                      = Superbook::select('total_saldo')->where('nama_akun', 'Persediaan')->where('id_pengguna',$id_pengguna)->first();
        $perlengkapan                    = Superbook::select('total_saldo')->where('nama_akun', 'Perlengkapan')->where('id_pengguna',$id_pengguna)->first();
        $Sewa_Dibayar_Di_Muka            = Superbook::select('total_saldo')->where('nama_akun', 'Sewa Dibayar Di Muka')->where('id_pengguna',$id_pengguna)->first();
        $Aset_Lancar_Lainnya             = Superbook::select('total_saldo')->where('nama_akun', 'Aset Lancar Lainnya')->where('id_pengguna',$id_pengguna)->first();

        //asset tetap

        $Tanah                          = Superbook::select('total_saldo')->where('nama_akun', 'Tanah')->where('id_pengguna',$id_pengguna)->first();
        $Bangunan                       = Superbook::select('total_saldo')->where('nama_akun', 'Bangunan')->where('id_pengguna',$id_pengguna)->first();
        $Akumulasi_Penyusutan_Bangunan  = Superbook::select('total_saldo')->where('nama_akun', 'Akumulasi Penyusutan Bangunan')->where('id_pengguna',$id_pengguna)->first();
        $Kendaraan                      = Superbook::select('total_saldo')->where('nama_akun', 'Kendaraan')->where('id_pengguna',$id_pengguna)->first();
        $Akumulasi_Penyusutan_Kendaraan = Superbook::select('total_saldo')->where('nama_akun', 'Akumulasi Penyusutan Kendaraan')->where('id_pengguna',$id_pengguna)->first();
        $Peralatan                      = Superbook::select('total_saldo')->where('nama_akun', 'Peralatan')->where('id_pengguna',$id_pengguna)->first();
        $Akumulasi_Penyusutan_Peralatan = Superbook::select('total_saldo')->where('nama_akun', 'Akumulasi Penyusutan Peralatan')->where('id_pengguna',$id_pengguna)->first();
        $Aset_Tetap_Lainnya             = Superbook::select('total_saldo')->where('nama_akun', 'Aset Tetap Lainnya')->where('id_pengguna',$id_pengguna)->first();
        $Aset_Lainnya                   = Superbook::select('total_saldo')->where('nama_akun', 'Aset Lainnya')->where('id_pengguna',$id_pengguna)->first();

        //Utang LANCAR

        $Utang_usaha                    = Superbook::select('total_saldo')->where('nama_akun', 'Utang usaha')->where('id_pengguna',$id_pengguna)->first();
        $Utang_beban                    = Superbook::select('total_saldo')->where('nama_akun', 'Utang beban')->where('id_pengguna',$id_pengguna)->first();

        //utang jangka panjang

        $Utang_Bank                     = Superbook::select('total_saldo')->where('nama_akun', 'Utang Bank')->where('id_pengguna',$id_pengguna)->first();   
        $Utang_lainnya                  = Superbook::select('total_saldo')->where('nama_akun', 'Utang lainnya')->where('id_pengguna',$id_pengguna)->first(); 

        //modal

        $Modal                          = Superbook::select('total_saldo')->where('nama_akun',  'Modal')->where('id_pengguna',$id_pengguna)->first() ;

        $total_asset_lancar             = $kas->total_saldo + $piutang_usaha->total_saldo + $persediaan->total_saldo + $perlengkapan->total_saldo + $Sewa_Dibayar_Di_Muka->total_saldo + $Aset_Lancar_Lainnya->total_saldo;
        $total_aset_tetap               = $Tanah->total_saldo + $Bangunan->total_saldo + $Akumulasi_Penyusutan_Bangunan->total_saldo + $Kendaraan->total_saldo + $Akumulasi_Penyusutan_Kendaraan->total_saldo + $Peralatan->total_saldo + $Akumulasi_Penyusutan_Peralatan->total_saldo + $Aset_Lainnya->total_saldo + $Aset_Tetap_Lainnya->total_saldo;       
        $total_utang_lancar             = $Utang_usaha->total_saldo + $Utang_beban->total_saldo;
        $total_utang_jangka_panjang     = $Utang_Bank->total_saldo;
        $total_asset                    = $total_aset_tetap + $total_asset_lancar;
        $total_utang                    = $total_utang_lancar + $total_utang_jangka_panjang + $Utang_lainnya->total_saldo;
        $total_utang_dan_modal          = $total_utang + $Modal->total_saldo;
   
        return view('sahl.laporan_neraca.laporan',compact( 'kas','piutang_usaha','persediaan','perlengkapan','Sewa_Dibayar_Di_Muka','Aset_Lancar_Lainnya',
                                                'Tanah','Bangunan','Akumulasi_Penyusutan_Bangunan','Kendaraan','Akumulasi_Penyusutan_Kendaraan','Peralatan','Akumulasi_Penyusutan_Peralatan','Aset_Tetap_Lainnya','Aset_Lainnya'
                                                ,'Utang_usaha','Utang_beban','Utang_Bank','total_aset_tetap','total_asset','total_utang_jangka_panjang'
                                                ,'total_asset_lancar','tanggal','total_utang_lancar','Modal','total_utang','total_utang_dan_modal'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
