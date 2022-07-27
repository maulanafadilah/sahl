<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Account;
use App\Superbook;
use App\General_journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show($id, $account)
    {
        $year = $id;
        $acc = rawurldecode($account);
        $id_pengguna = auth()->user()->id;
        
        $saldo_awal_debit = Asset::select(DB::raw('SUM(assets.nominal) as nominal_debit'))->where('assets.nama_asset', $acc)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Debit')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();
        $saldo_awal_kredit = Asset::select(DB::raw('SUM(assets.nominal) as nominal_kredit'))->where('assets.nama_asset', $acc)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Kredit')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();
        
        $posting_debit = General_journal::select(DB::raw('SUM(general_journals.debit) as pdebit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.debit', $acc)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
        $posting_kredit = General_journal::select(DB::raw('SUM(general_journals.kredit) as pkredit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.kredit', $acc)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
        
        // return $saldo_awal_debit;
        if($saldo_awal_debit->nominal_debit != null){
            $total_saldo_debit = $saldo_awal_debit->nominal_debit + $posting_debit->pdebit - $posting_kredit->pkredit;
            $total_saldo_kredit= false;

            // check if the value is the same
            $check_db = Superbook::select('total_saldo')->where('nama_akun', $acc)->where('jenis_saldo', 'Debit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
            // return $check_db;
            if($check_db == null){
                Superbook::create(['nama_akun' => $acc, 'total_saldo' => $total_saldo_debit, 'jenis_saldo' => 'Debit', 'tahun'=>$year, 'id_pengguna' => $id_pengguna]);
                return view('sahl.buku_besar.detail', compact('year', 'acc', 'id_pengguna', 'saldo_awal_debit', 'saldo_awal_kredit', 'posting_debit', 'posting_kredit', 'total_saldo_debit', 'total_saldo_kredit'));
            } elseif($check_db->total_saldo != $total_saldo_debit){
                Superbook::where('nama_akun', $acc)->where('jenis_saldo', 'Debit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_debit]);
                return view('sahl.buku_besar.detail', compact('year', 'acc', 'id_pengguna', 'saldo_awal_debit', 'saldo_awal_kredit', 'posting_debit', 'posting_kredit', 'total_saldo_debit', 'total_saldo_kredit'));
            } else{
                return view('sahl.buku_besar.detail', compact('year', 'acc', 'id_pengguna', 'saldo_awal_debit', 'saldo_awal_kredit', 'posting_debit', 'posting_kredit', 'total_saldo_debit', 'total_saldo_kredit'));
            }

        } elseif ($saldo_awal_kredit->nominal_kredit !== null){
            $total_saldo_kredit= $saldo_awal_kredit->nominal_kredit + $posting_kredit->pkredit - $posting_debit->pdebit;
            $total_saldo_debit = false;

            // check if the value is the same
            $check_db = Superbook::select('total_saldo')->where('nama_akun', $acc)->where('jenis_saldo', 'Kredit')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
            if($check_db == null){
                Superbook::create(['nama_akun' => $acc, 'total_saldo' => $total_saldo_kredit, 'jenis_saldo' => 'Kredit', 'tahun'=>$year,'id_pengguna' => $id_pengguna]);
                return view('sahl.buku_besar.detail', compact('year', 'acc', 'id_pengguna', 'saldo_awal_debit', 'saldo_awal_kredit', 'posting_debit', 'posting_kredit', 'total_saldo_debit', 'total_saldo_kredit'));
            } elseif($check_db->total_saldo != $total_saldo_kredit){
                Superbook::where('nama_akun', $acc)->where('jenis_saldo', 'Kredit')->where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $total_saldo_kredit]);
                return view('sahl.buku_besar.detail', compact('year', 'acc', 'id_pengguna', 'saldo_awal_debit', 'saldo_awal_kredit', 'posting_debit', 'posting_kredit', 'total_saldo_debit', 'total_saldo_kredit'));
            } else{
                return view('sahl.buku_besar.detail', compact('year', 'acc', 'id_pengguna', 'saldo_awal_debit', 'saldo_awal_kredit', 'posting_debit', 'posting_kredit', 'total_saldo_debit', 'total_saldo_kredit'));
            }
        } else{
            $total_saldo_kredit= false;
            $total_saldo_debit = false;
            return view('sahl.buku_besar.detail', compact('year', 'acc', 'id_pengguna', 'saldo_awal_kredit', 'saldo_awal_debit', 'posting_debit', 'posting_kredit', 'total_saldo_kredit', 'total_saldo_debit'));
        }

        // return $saldo_awal_kredit;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
