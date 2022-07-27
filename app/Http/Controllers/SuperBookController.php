<?php

namespace App\Http\Controllers;

use App\Account;
use App\Asset;
use App\General_journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $account = Account::select('nomor_akun', 'nama_akun')->get();
        // $kas_awal = Asset::select(DB::raw('SUM(nominal) as nominal'))->where('nama_asset', 'Kas')->where('id_pengguna', $id_pengguna)->where('created_at', 'LIKE', '%'.$id.'%')->first();
        // $kas_posting_debit = General_journal::select(DB::raw('SUM(general_journals.debit) as gdebit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$id.'%')->where('transactions.debit', 'Kas')->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();

        // return $kas_posting_debit;
        // return view('sahl.buku_besar.show', compact('year', 'account', 'kas_awal', 'kas_posting_debit'));
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
