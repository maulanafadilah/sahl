<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $create = 'Utang';
        // $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '2%')->get();
        // return view('sahl.input.debt.create', compact('create', 'account'));
        $debt = Debt::select('id', 'nama_utang', 'nominal', 'keterangan', DB::raw('DATE(created_at) as date'))->where('id_pengguna', auth()->user()->id)->get();

        // return $debt;
        return view('sahl.input.debt.index', compact('debt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = 'Utang';
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '2%')->get();
        return view('sahl.input.debt.create', compact('create', 'account'));
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

        $nominal = str_replace( array( '.', 'Rp',
        ',' ), '', $validatedData['nominal']);
        $nominal = substr($nominal, 0, -2);

        Debt::create(['nama_utang'=>$validatedData['nama_utang'], 'nominal'=>$nominal,'keterangan'=>$validatedData['keterangan'], 'id_pengguna'=>auth()->user()->id]);
        return redirect('utang')->with('success', 'Berhasil Menambahkan Utang!');
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
    public function edit($id)
    {
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '2%')->get();
        $debt = Debt::select('*')->where('id', $id)->get()[0];


        // return $debt;
        return view('sahl.input.debt.edit', compact( 'account', 'debt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_utang' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable',
        ]);

        $nominal = str_replace( array( '.', 'Rp',
        ',' ), '', $validatedData['nominal']);
        $nominal = substr($nominal, 0, -2);

        Debt::where('id', $id)->update(['nama_utang'=>$validatedData['nama_utang'], 'nominal'=>$nominal,'keterangan'=>$validatedData['keterangan']]);
        return redirect('utang')->with('success', 'Berhasil Mengubah Utang!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Debt  $debt
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Debt::destroy($id);
        return redirect('utang')->with('success', 'Berhasil Menghapus Utang!');
    }
}
