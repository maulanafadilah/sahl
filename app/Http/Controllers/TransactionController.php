<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\General_journal;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $create = 'Transaksi';
        $account = Transaction::select('id', 'nama_transaksi')->get();
        return view('sahl.input.transaction.create', compact('create', 'account'));
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
        // return $request;
        $validatedData = $request->validate([
            'tanggal' => 'required',
            'transaksi' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable',
        ]);

        $nominal = str_replace( array( '.', 'Rp',
        ',' ), '', $validatedData['nominal']);
        $nominal = substr($nominal, 0, -2);
        // return $validatedData;

        General_journal::create(['tanggal' => $validatedData['tanggal'],
        'id_transaksi' => $validatedData['transaksi'],
        'debit' => $nominal,
        'kredit' => $nominal,
        'keterangan'=> $validatedData['keterangan'],
        'id_pengguna' => auth()->user()->id]);
        return redirect('transaksi')->with('success', 'Berhasil Menambahkan Transaksi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
