<?php

namespace App\Http\Controllers;

use App\Account;
use App\Transaction;
use App\General_journal;
use Illuminate\Http\Request;

class GeneralJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurnals = General_journal::select('general_journals.id', 'general_journals.tanggal', 'general_journals.debit', 'general_journals.kredit', 'general_journals.keterangan', 'transactions.debit as transaksi_1', 'transactions.kredit as transaksi_2')->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->where('id_pengguna', auth()->user()->id)->get();

        // return $jurnals;
        return view('sahl.jurnal_umum.index', compact('jurnals'));
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
     * @param  \App\General_journal  $general_journal
     * @return \Illuminate\Http\Response
     */
    public function show(General_journal $general_journal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\General_journal  $general_journal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $create = 'Transaksi';
        $account = Transaction::select('id as id_transaksi', 'nama_transaksi')->get();

        // return $account;
        $transaction = General_journal::select('*')->where('id', $id)->get()[0];
        return view('sahl.input.transaction.edit', compact('transaction', 'create', 'account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\General_journal  $general_journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'transaksi' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable',
        ]);

        General_journal::where('id', $id)
        ->update(['tanggal' => $validatedData['tanggal'],
        'id_transaksi' => $validatedData['transaksi'],
        'debit' => $validatedData['nominal'],
        'kredit' => $validatedData['nominal'],
        'keterangan'=> $validatedData['keterangan'],
        'id_pengguna' => auth()->user()->id]);
        return redirect('jurnal-umum')->with('success', 'Berhasil Mengubah Transaksi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\General_journal  $general_journal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        General_journal::destroy($id);
        return redirect('jurnal-umum')->with('success', 'Berhasil Menghapus Transaksi!');
    }
}
