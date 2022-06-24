<?php

namespace App\Http\Controllers;

use App\Account;
use App\General_journal;
use App\Transaction;
use Illuminate\Http\Request;

class InputController extends Controller
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
    public function create($id)
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
            'akun' => 'required',
            'transaksi' => 'required',
            'nominal' => 'required'
        ]);

        // return $validatedData;

        General_journal::create(['tanggal' => $request->tanggal,
        'akun' => $request->akun,
        'transaksi' => $request->transaksi,
        'kredit' => $request->nominal,
        'debit' => $request->nominal,
        'keterangan'=> $request->keterangan,
        'id_pengguna' => auth()->user()->id]);
        return redirect('jurnal-umum')->with('success', 'Berhasil Mengubah Kategori!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $create = $id;
        switch ($id) {
            case ($id == 'asset'):
                $create = 'Asset';
                $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '1%')->get();                
                
                break;
            case ($id == 'utang'):
                $create = 'Utang';
                $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '2%')->get();                
                break;
            case ($id == 'modal'):
                $create = 'Modal';
                $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '3%')->get();                
                break;
            case ($id == 'transaksi'):
                $create = 'Transaksi';
                $account = Transaction::select('id', 'nama_transaksi')->get();                
                break;
        }
        return view('sahl.input.create', compact('create', 'account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(account $account)
    {
        //
    }
}
