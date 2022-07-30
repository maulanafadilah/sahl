<?php

namespace App\Http\Controllers;

use App\Laba_rugi;
use App\Superbook;
use App\Perubahan_modal;
use Illuminate\Http\Request;

class PerubahanModalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_pengguna = auth()->user()->id;
        $year = Superbook::select('tahun')->where('id_pengguna', $id_pengguna)->groupBy('tahun')->get();
        
        // return $year;
        return view('sahl.perubahan_modal.index', compact('year'));
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
     * @param  \App\Perubahan_modal  $perubahan_modal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $year = $id;
        $id_pengguna = auth()->user()->id;
        $company = auth()->user()->nama_perusahaan;

        $modal_awal = Superbook::select('total_saldo')->where('nama_akun', 'Modal')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $laba_rugi = Laba_rugi::select('total_saldo')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $prive = Superbook::select('total_saldo')->where('nama_akun', 'Prive')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();

        $penambahan_pengurangan_modal = $laba_rugi->total_saldo + $prive->total_saldo;
        $modal_akhir = $modal_awal->total_saldo + $penambahan_pengurangan_modal;

        $check_db = Perubahan_modal::select('total_saldo')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        switch(true){
            case($check_db == NULL):
                Perubahan_modal::create(['total_saldo'=>$modal_akhir, 'tahun'=>$year, 'id_pengguna'=>$id_pengguna]);
                break;
            case($check_db->total_saldo != $modal_akhir):
                Perubahan_modal::where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $modal_akhir]);
                break;
        }

        // return $laba_rugi;

        return view('sahl.perubahan_modal.show', compact('year', 'company', 'modal_awal', 'laba_rugi', 'prive', 'penambahan_pengurangan_modal', 'modal_akhir'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perubahan_modal  $perubahan_modal
     * @return \Illuminate\Http\Response
     */
    public function edit(Perubahan_modal $perubahan_modal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perubahan_modal  $perubahan_modal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perubahan_modal $perubahan_modal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perubahan_modal  $perubahan_modal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perubahan_modal $perubahan_modal)
    {
        //
    }
}
