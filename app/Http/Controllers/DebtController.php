<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Account;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $create = 'Asset';
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '2%')->get();
        return view('sahl.input.debt.create', compact('create', 'account'));
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
            'nama_utang' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable',
        ]);

        Debt::create($validatedData + ['id_pengguna'=>auth()->user()->id]);
        return redirect('asset')->with('success', 'Berhasil Menambahkan Utang!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function show(Debt $debt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function edit(Debt $debt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Debt $debt)
    {
        //
    }
}
