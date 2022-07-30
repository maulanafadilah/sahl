<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asset = Asset::select('id', 'nama_asset', 'nominal', 'keterangan', DB::raw('DATE(created_at) as date'))->where('id_pengguna', auth()->user()->id)->get();
        return view('sahl.input.asset.index', compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = 'Asset';
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '1%')->get();
        return view('sahl.input.asset.create', compact('create', 'account'));
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
            'nama_asset' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable',
        ]);

        Asset::create($validatedData + ['id_pengguna'=>auth()->user()->id]);
        return redirect('asset')->with('success', 'Berhasil Menambahkan Asset!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::select('id', 'nomor_akun', 'nama_akun')->where('nomor_akun', 'LIKE', '1%')->get();
        $asset = Asset::select('*')->where('id', $id)->get()[0];
        return view('sahl.input.asset.edit', compact( 'account', 'asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_asset' => 'required',
            'nominal' => 'required',
            'keterangan' => 'nullable',
        ]);
        Asset::where('id', $id)->update($validatedData);
        return redirect('asset')->with('success', 'Berhasil Mengubah Asset!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asset::destroy($id);
        return redirect('asset')->with('success', 'Berhasil Menghapus Asset!');
    }
}
