<?php

namespace App\Http\Controllers;

use App\Account;
use App\auth;
use App\Debt;
use App\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\General_Journal;

class NeracaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //asset Lancar

        $id_pengguna                     = Auth()->user()->id;
        $kas                             = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Kas')->where('id_pengguna',$id_pengguna)->get();
        $piutang_usaha                   = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Piutang usaha')->where('id_pengguna',$id_pengguna)->get();
        $persediaan                      = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Persediaan')->where('id_pengguna',$id_pengguna)->get();
        $perlengkapan                    = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Perlengkapan')->where('id_pengguna',$id_pengguna)->get();
        $Sewa_Dibayar_Di_Muka            = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Sewa Dibayar Di Muka')->where('id_pengguna',$id_pengguna)->get();
        $Aset_Lancar_Lainnya             = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Aset Lancar Lainnya')->where('id_pengguna',$id_pengguna)->get();

        //Asset tetap

        $Tanah                          = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Tanah')->where('id_pengguna',$id_pengguna)->get();
        $Bangunan                       = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Bangunan')->where('id_pengguna',$id_pengguna)->get();
        $Akumulasi_Penyusutan_Bangunan  = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Akumulasi Penyusutan Bangunan')->where('id_pengguna',$id_pengguna)->get();
        $Kendaraan                      = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Kendaraan')->where('id_pengguna',$id_pengguna)->get();
        $Akumulasi_Penyusutan_Kendaraan = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Akumulasi Penyusutan Kendaraan')->where('id_pengguna',$id_pengguna)->get();
        $Peralatan                      = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Peralatan')->where('id_pengguna',$id_pengguna)->get();
        $Akumulasi_Penyusutan_Peralatan = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Akumulasi Penyusutan Peralatan')->where('id_pengguna',$id_pengguna)->get();
        $Aset_Tetap_Lainnya             = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Aset Tetap Lainnya')->where('id_pengguna',$id_pengguna)->get();
        $Aset_Lainnya                   = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Aset Lainnya')->where('id_pengguna',$id_pengguna)->get();

        //Utang LANCAR

        $Utang_usaha                    = Debt::select(DB::raw('SUM(nominal) as nominal'))->where('nama_utang', 'Utang usaha')->where('id_pengguna',$id_pengguna)->get();
        $Utang_beban                    = Debt::select(DB::raw('SUM(nominal) as nominal'))->where('nama_utang', 'Utang beban')->where('id_pengguna',$id_pengguna)->get();

        //utang jangka panjang

        $Utang_Bank                     = Debt::select(DB::raw('SUM(nominal) as nominal'))->where('nama_utang', 'Utang Bank')->where('id_pengguna',$id_pengguna)->get();        
        


        return view('sahl.neraca.awal',compact( 'kas','piutang_usaha','persediaan','perlengkapan','Sewa_Dibayar_Di_Muka','Aset_Lancar_Lainnya',
                                                'Tanah','Bangunan','Akumulasi_Penyusutan_Bangunan','Kendaraan','Akumulasi_Penyusutan_Kendaraan','Peralatan','Akumulasi_Penyusutan_Peralatan','Aset_Tetap_Lainnya','Aset_Lainnya'
                                                ,'Utang_usaha','Utang_beban','Utang_Bank'));
    }

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cetakpdf()
    {
        $id_pengguna                     = Auth()->user()->id;
        $kas                             = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Kas')->where('id_pengguna',$id_pengguna)->get();
        $piutang_usaha                   = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Piutang usaha')->where('id_pengguna',$id_pengguna)->get();
        $persediaan                      = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Persediaan')->where('id_pengguna',$id_pengguna)->get();
        $perlengkapan                    = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Perlengkapan')->where('id_pengguna',$id_pengguna)->get();
        $Sewa_Dibayar_Di_Muka            = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Sewa Dibayar Di Muka')->where('id_pengguna',$id_pengguna)->get();
        $Aset_Lancar_Lainnya             = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Aset Lancar Lainnya')->where('id_pengguna',$id_pengguna)->get();

        //Asset tetap

        $Tanah                          = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Tanah')->where('id_pengguna',$id_pengguna)->get();
        $Bangunan                       = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Bangunan')->where('id_pengguna',$id_pengguna)->get();
        $Akumulasi_Penyusutan_Bangunan  = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Akumulasi Penyusutan Bangunan')->where('id_pengguna',$id_pengguna)->get();
        $Kendaraan                      = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Kendaraan')->where('id_pengguna',$id_pengguna)->get();
        $Akumulasi_Penyusutan_Kendaraan = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Akumulasi Penyusutan Kendaraan')->where('id_pengguna',$id_pengguna)->get();
        $Peralatan                      = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Peralatan')->where('id_pengguna',$id_pengguna)->get();
        $Akumulasi_Penyusutan_Peralatan = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Akumulasi Penyusutan Peralatan')->where('id_pengguna',$id_pengguna)->get();
        $Aset_Tetap_Lainnya             = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Aset Tetap Lainnya')->where('id_pengguna',$id_pengguna)->get();
        $Aset_Lainnya                   = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Aset Lainnya')->where('id_pengguna',$id_pengguna)->get();

        //Utang LANCAR

        $Utang_usaha                    = Debt::select(DB::raw('SUM(nominal) as nominal'))->where('nama_utang', 'Utang usaha')->where('id_pengguna',$id_pengguna)->get();
        $Utang_beban                    = Debt::select(DB::raw('SUM(nominal) as nominal'))->where('nama_utang', 'Utang beban')->where('id_pengguna',$id_pengguna)->get();

        //utang jangka panjang

        $Utang_Bank                     = Debt::select(DB::raw('SUM(nominal) as nominal'))->where('nama_utang', 'Utang Bank')->where('id_pengguna',$id_pengguna)->get();
        
        return view('sahl.neraca.cetakpdf',compact( 'kas','piutang_usaha','persediaan','perlengkapan','Sewa_Dibayar_Di_Muka','Aset_Lancar_Lainnya',
        'Tanah','Bangunan','Akumulasi_Penyusutan_Bangunan','Kendaraan','Akumulasi_Penyusutan_Kendaraan','Peralatan','Akumulasi_Penyusutan_Peralatan','Aset_Tetap_Lainnya','Aset_Lainnya'
        ,'Utang_usaha','Utang_beban','Utang_Bank'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function NeracaSaldo()
    {  
        $year = ('2022');
        $id_pengguna = auth() ->user()->id;

        $debit                  = Account::select('nama_akun')->where('nama_akun', 'LIKE', '%debit%')->orderBy("nomor_akun")->limit('3')->get();
        $kredit                 = Account::select('nama_akun')->where('nama_akun', 'LIKE', '%kredit%')->orderBy("nomor_akun")->get();

        $neraca_debit           = Asset::select(DB::raw('SUM(assets.nominal) as nominal_debit'))->where('assets.nama_asset', $debit)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Debit')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();
        $neraca_kredit          = Asset::select(DB::raw('SUM(assets.nominal) as nominal_kredit'))->where('assets.nama_asset', $kredit)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Kredit')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();
        
        $posting_debit          = General_journal::select(DB::raw('SUM(general_journals.debit) as pdebit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.debit', $debit)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
        $posting_kredit         = General_journal::select(DB::raw('SUM(general_journals.kredit) as pkredit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.kredit', $kredit)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();

	  $total_debit              = $neraca_debit->nominal_debit + $posting_debit->pdebit - $posting_kredit->pkredit;
        $total_kredit           = $neraca_kredit->nominal_kredit + $posting_kredit->pkredit - $posting_debit->pdebit;


        return view('sahl.neraca.saldo',compact($debit,$kredit,$neraca_debit,$neraca_kredit,$posting_debit,$posting_kredit,$total_debit,$total_kredit));
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
    public function show(auth $auth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function edit(auth $auth)
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
    public function update(Request $request, auth $auth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\auth  $auth
     * @return \Illuminate\Http\Response
     */
    public function destroy(auth $auth)
    {
        //
    }
}
