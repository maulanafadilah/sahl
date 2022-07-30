<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Account;
use App\Superbook;
use App\General_journal;
use App\Laba_rugi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabaRugiController extends Controller
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
        return view('sahl.laba_rugi.index', compact('year'));
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
        $company = auth()->user()->nama_perusahaan;

        
        // Penjualan
        $penjualan = Superbook::select('total_saldo')->where('nama_akun', 'Penjualan')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $retur_penjualan = Superbook::select('total_saldo')->where('nama_akun', 'Retur Penjualan')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $potongan_penjualan = Superbook::select('total_saldo')->where('nama_akun', 'Potongan Penjualan')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        
        $penjualan_bersih = $penjualan->total_saldo + $retur_penjualan->total_saldo + $potongan_penjualan->total_saldo;

        // Persediaan
        $persediaan_awal = Superbook::select('total_saldo')->where('nama_akun', 'Persediaan')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();

        // Pembelian
        $pembelian = Superbook::select('total_saldo')->where('nama_akun', 'Pembelian')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $retur_pembelian = Superbook::select('total_saldo')->where('nama_akun', 'Retur Pembelian')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $potongan_pembelian = Superbook::select('total_saldo')->where('nama_akun', 'Potongan Pembelian')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $pembelian_bersih = $pembelian->total_saldo + $retur_pembelian->total_saldo + $potongan_pembelian->total_saldo;

        $persediaan_dijual = $persediaan_awal->total_saldo + $pembelian_bersih;
        
        $persediaan_akhir = General_journal::select(DB::raw('SUM(general_journals.debit) as nominal'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.nama_transaksi', 'Persediaan Akhir')->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
        
        $pokok_penjualan = $persediaan_dijual - $persediaan_akhir->nominal;
        
        $laba_kotor = $penjualan_bersih - $pokok_penjualan;

        // Pendapatan
        $pendapatan_jasa = Superbook::select('total_saldo')->where('nama_akun', 'Pendapatan Jasa')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $pendapatan_sewa = Superbook::select('total_saldo')->where('nama_akun', 'Pendapatan Sewa')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $pendapatan_lain = Superbook::select('total_saldo')->where('nama_akun', 'Pendapatan Lainnya')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $total_pendapatan = $pendapatan_jasa->total_saldo + $pendapatan_sewa->total_saldo + $pendapatan_lain->total_saldo;
        
        // Beban
        $beban_gaji = Superbook::select('total_saldo')->where('nama_akun', 'Beban Gaji')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $beban_listrik = Superbook::select('total_saldo')->where('nama_akun', 'LIKE', '%Beban Listrik%')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $beban_perlengkapan = Superbook::select('total_saldo')->where('nama_akun', 'Beban Perlengkapan')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $beban_sewa = Superbook::select('total_saldo')->where('nama_akun', 'Beban Sewa')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        $beban_penyusutan = Superbook::select('total_saldo')->where('nama_akun', 'Beban Penyusutan')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();

        $total_beban = $beban_gaji->total_saldo + $beban_listrik->total_saldo + $beban_perlengkapan->total_saldo + $beban_sewa->total_saldo + $beban_penyusutan->total_saldo;

        $laba_rugi_bersih = $laba_kotor + $total_pendapatan - $total_beban;

        $check_db = Laba_rugi::select('total_saldo')->where('id_pengguna', $id_pengguna)->where('tahun', $year)->first();
        // var_dump($check_db);
        // die;
        switch(true){
            case($check_db == NULL):
                Laba_rugi::create(['total_saldo'=>$laba_rugi_bersih, 'tahun'=>$year, 'id_pengguna'=>$id_pengguna]);
                break;
            case($check_db->total_saldo != $laba_rugi_bersih):
                Laba_rugi::where('tahun', $year)->where('id_pengguna', $id_pengguna)->update(['total_saldo' => $laba_rugi_bersih]);
                break;
        }

        return view('sahl.laba_rugi.show', compact('year', 'company', 'penjualan', 'retur_penjualan', 'potongan_penjualan', 'penjualan_bersih', 'persediaan_awal', 'pembelian', 'retur_pembelian', 'potongan_pembelian', 'pembelian_bersih', 'persediaan_dijual', 'persediaan_akhir', 'pokok_penjualan', 'laba_kotor', 'pendapatan_jasa', 'pendapatan_sewa', 'pendapatan_lain', 'total_pendapatan', 'beban_gaji', 'beban_listrik', 'beban_perlengkapan', 'beban_sewa', 'beban_penyusutan', 'total_beban', 'laba_rugi_bersih'));
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
}
