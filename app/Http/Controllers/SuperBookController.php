<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Account;
use App\Superbook;
use App\General_journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Break_;

class SuperBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_pengguna = auth()->user()->id;
        $year = Asset::select(DB::raw('YEAR(created_at) as year'))->where('id_pengguna', $id_pengguna)->groupBy(DB::raw('YEAR(created_at) '))->get();
        
        return view('sahl.buku_besar.index', compact('year'));
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
        $year = $id;
        $id_pengguna = auth()->user()->id;
        $account = Account::select('nomor_akun', 'nama_akun', 'tipe_saldo')->get();

        foreach($account as $item){
            $saldo_awal_debit = Asset::select(DB::raw('SUM(assets.nominal) as nominal_debit'), 'nama_asset')->where('assets.nama_asset', $item->nama_akun)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Debit')->groupBy('nama_asset')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();
            $saldo_awal_kredit = Asset::select(DB::raw('SUM(assets.nominal) as nominal_kredit'), 'nama_asset')->where('assets.nama_asset', $item->nama_akun)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Kredit')->groupBy('nama_asset')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();
            // $kas_awal = Asset::select(DB::raw('SUM(nominal) as nominal_'), 'nama_asset')->where('nama_asset', $item->nama_akun)->where('id_pengguna', $id_pengguna)->where('created_at', 'LIKE', '%'.$id.'%')->groupBy('nama_asset')->first();
            // $posting_debit = General_journal::select(DB::raw('SUM(general_journals.debit) as pdebit'), 'transactions.debit')->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.debit', $item->nama_akun)->groupBy('transactions.debit')->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
            $posting_debit = General_journal::select(DB::raw('SUM(general_journals.debit) as pdebit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.debit', $item->nama_akun)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
            $posting_kredit = General_journal::select(DB::raw('SUM(general_journals.kredit) as pkredit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.kredit', $item->nama_akun)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
            
            // echo $saldo_awal_debit;
            switch(true){
                case ($saldo_awal_debit !== null):
                    $total_saldo_debit = $saldo_awal_debit->nominal_debit + $posting_debit->pdebit - $posting_kredit->pkredit;
                    $total_saldo_kredit= false;
                    
                    $check_db = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                    // echo $check_db;
                    switch($check_db){
                        case($check_db == 'null'):
                            Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_debit, 'jenis_saldo' => 'Debit', 'tahun'=>$year, 'id_pengguna' => $id_pengguna]);
                            break;
                        case($check_db->total_saldo != $total_saldo_debit):
                            Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_debit]);
                            break;
                    }
                    break;
                case ($saldo_awal_kredit !== null):
                    $total_saldo_kredit= $saldo_awal_kredit->nominal_kredit + $posting_kredit->pkredit - $posting_debit->pdebit;
                    $total_saldo_debit = false;

                    $check_db = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                    // echo $check_db;
                    switch($check_db){
                        case($check_db == 'null'):
                            Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_kredit, 'jenis_saldo' => 'Kredit', 'tahun'=>$year,'id_pengguna' => $id_pengguna]);
                            break;
                        case($check_db->total_saldo != $total_saldo_kredit):
                            Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_kredit]);
                            break;
                    }
                    break;

                case($item->nomor_akun <= '3-1100'):
                    if ($item->tipe_saldo == "Debit") {
                        $total_saldo_debit = $saldo_awal_debit + $posting_debit->pdebit - $posting_kredit->pkredit;
                        $total_saldo_kredit= false;

                        $check_db_debit = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                        // echo $check_db_debit;
                        switch($check_db_debit){
                            case($check_db_debit == 'null'):
                                Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_debit, 'jenis_saldo' => 'Debit', 'tahun'=>$year, 'id_pengguna' => $id_pengguna]);
                                break;
                            case($check_db_debit->total_saldo != $total_saldo_debit):
                                Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_debit]);
                                break;
                        }
                    }else{
                        $total_saldo_kredit= $saldo_awal_kredit + $posting_kredit->pkredit - $posting_debit->pdebit;
                        $total_saldo_debit = false;
                        
                        $check_db_kredit = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                        // echo $check_db_kredit;
                        switch($check_db_kredit){
                            case($check_db_kredit == 'null'):
                                Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_kredit, 'jenis_saldo' => 'Kredit', 'tahun'=>$year,'id_pengguna' => $id_pengguna]);
                                break;
                            case($check_db_kredit->total_saldo != $total_saldo_kredit):
                                Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_kredit]);
                                break;
                        }
                    }
                    break;
                
                case($item->nomor_akun >= '3-1200'):
                    
                    if ($item->tipe_saldo == "Debit") {
                        $total_saldo_debit = $saldo_awal_debit + $posting_debit->pdebit - $posting_kredit->pkredit;
                        $total_saldo_kredit= false;

                        $check_db_debit = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                        // echo $check_db_debit;
                        switch($check_db_debit){
                            case($check_db_debit == 'null'):
                                Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_debit, 'jenis_saldo' => 'Debit', 'tahun'=>$year, 'id_pengguna' => $id_pengguna]);
                                break;
                            case($check_db_debit->total_saldo != $total_saldo_debit):
                                Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_debit]);
                                break;
                        }
                    }else{
                        $total_saldo_kredit= $saldo_awal_kredit + $posting_kredit->pkredit - $posting_debit->pdebit;
                        $total_saldo_debit = false;
                        
                        $check_db_kredit = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                        // echo $check_db_kredit;
                        switch($check_db_kredit){
                            case($check_db_kredit == 'null'):
                                Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_kredit, 'jenis_saldo' => 'Kredit', 'tahun'=>$year,'id_pengguna' => $id_pengguna]);
                                break;
                            case($check_db_kredit->total_saldo != $total_saldo_kredit):
                                Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_kredit]);
                                break;
                        }
                    }
                    // $total_saldo_debit = $saldo_awal_debit + $posting_debit->pdebit - $posting_kredit->pkredit;
                    // $total_saldo_kredit= $saldo_awal_kredit + $posting_kredit->pkredit - $posting_debit->pdebit;

                    // $check_db_debit = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                    // // echo $check_db_debit;
                    // switch($check_db_debit){
                    //     case($check_db_debit == 'null'):
                    //         Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_debit, 'jenis_saldo' => 'Debit', 'tahun'=>$year, 'id_pengguna' => $id_pengguna]);
                    //         break;
                    //     case($check_db_debit->total_saldo != $total_saldo_debit):
                    //         Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Debit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_debit]);
                    //         break;
                    // }

                    // $check_db_kredit = Superbook::select('total_saldo')->where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
                    // // echo $check_db_kredit;
                    // switch($check_db_kredit){
                    //     case($check_db_kredit == 'null'):
                    //         Superbook::create(['nama_akun' => $item->nama_akun, 'total_saldo' => $total_saldo_kredit, 'jenis_saldo' => 'Kredit', 'tahun'=>$year,'id_pengguna' => $id_pengguna]);
                    //         break;
                    //     case($check_db_kredit->total_saldo != $total_saldo_kredit):
                    //         Superbook::where('nama_akun', $item->nama_akun)->where('jenis_saldo', 'Kredit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_kredit]);
                    //         break;
                    // }

                    break;
            }

        }
        
        return view('sahl.buku_besar.show', compact('year', 'account'));
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

    public function accounts($id)
    {
        return $id;
    }
}
