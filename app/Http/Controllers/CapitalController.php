<?php

namespace App\Http\Controllers;

use App\Account;
use App\Capital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capital = Capital::select('id', 'nama_modal', 'nominal', 'keterangan', DB::raw('DATE(created_at) as date'))->where('id_pengguna', auth()->user()->id)->get();

        // return $debt;
        return view('sahl.input.capital.index', compact('capital'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = 'Modal';
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '3%')->get();
        return view('sahl.input.capital.create', compact('create', 'account'));
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

        $nominal = str_replace( array( '.', 'Rp',
        ',' ), '', $validatedData['nominal']);
        $nominal = substr($nominal, 0, -2);

        Capital::create(['nama_modal'=>$validatedData['nama_modal'], 'nominal'=>$nominal, 'keterangan'=>$validatedData['keterangan'],'id_pengguna'=>auth()->user()->id]);
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
    public function edit( $id)
    {
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '3%')->get();
        $capital = Capital::select('*')->where('id', $id)->get()[0];


        // return $debt;
        return view('sahl.input.capital.edit', compact( 'account', 'capital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_modal' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable',
        ]);

        $nominal = str_replace( array( '.', 'Rp',
        ',' ), '', $validatedData['nominal']);
        $nominal = substr($nominal, 0, -2);

        Capital::where('id', $id)->update(['nama_modal'=>$validatedData['nama_modal'], 'nominal'=>$nominal, 'keterangan'=>$validatedData['keterangan']]);
        return redirect('modal')->with('success', 'Berhasil Mengubah Modal!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Capital  $capital
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Capital::destroy($id);
        return redirect('modal')->with('success', 'Berhasil Menghapus Modal!');
    }
}
