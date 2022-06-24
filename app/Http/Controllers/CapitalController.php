<?php

namespace App\Http\Controllers;

use App\Account;
use App\Capital;
use Illuminate\Http\Request;

class CapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $create = 'Modal';
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '3%')->get();
        return view('sahl.input.capital.create', compact('create', 'account'));
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
            'nama_modal' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable'
        ]);

        Capital::create($validatedData + ['id_pengguna'=>auth()->user()->id]);
        return redirect('modal')->with('success', 'Berhasil Menambahkan Modal!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function show(Capital $capital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function edit(Capital $capital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Capital $capital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Capital $capital)
    {
        //
    }
}
