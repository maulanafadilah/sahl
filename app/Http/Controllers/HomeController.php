<?php

namespace App\Http\Controllers;

use App\Account;
use App\Asset;
use App\Capital;
use App\Debt;
use App\General_journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $asset = Asset::select(DB::raw('SUM(nominal) as jumlah_asset'))->where('id_pengguna', auth()->user()->id)->get()[0];
        $capital = Capital::select(DB::raw('SUM(nominal) as jumlah_modal'))->where('id_pengguna', auth()->user()->id)->get()[0];
        $debt = Debt::select(DB::raw('SUM(nominal) as jumlah_utang'))->where('id_pengguna', auth()->user()->id)->get()[0];

        $data1 = json_decode($asset->jumlah_asset, true);
        $data2 = json_decode($debt->jumlah_utang, true);
        $data3 = json_decode($capital->jumlah_modal, true);
        
        $data = [$data1, $data2, $data3];
        // return $data;
        return view('dashboard', compact('asset', 'capital', 'debt', 'data1', 'data2', 'data3'));
    }
    public function laba_rugi()
    {
        $penjualan = Account::select('nama_akun')->where('nama_akun', 'LIKE', '%Penjualan%')->orderBy("nomor_akun")->limit('3')->get();
        $pembelian = Account::select('nama_akun')->where('nama_akun', 'LIKE', '%Pembelian%')->orderBy("nomor_akun")->get();

        // return $penjualan;
        $year = 2022;
        $id_pengguna = auth()->user()->id;
        
            foreach($penjualan as $item){
                $saldo_awal_debit = Asset::select(DB::raw('SUM(assets.nominal) as nominal_debit'))->where('assets.nama_asset', $item->nama_akun)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Debit')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();
                $saldo_awal_kredit = Asset::select(DB::raw('SUM(assets.nominal) as nominal_kredit'))->where('assets.nama_asset', $item->nama_akun)->where('assets.id_pengguna', $id_pengguna)->where('assets.created_at', 'LIKE', '%'.$year.'%')->where('accounts.tipe_saldo', 'Kredit')->join('accounts', 'assets.nama_asset', '=', 'accounts.nama_akun')->first();

                $posting_debit = General_journal::select(DB::raw('SUM(general_journals.debit) as pdebit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.debit', $item->nama_akun)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();
                $posting_kredit = General_journal::select(DB::raw('SUM(general_journals.kredit) as pkredit'))->where('general_journals.id_pengguna', $id_pengguna)->where('general_journals.tanggal', 'LIKE', '%'.$year.'%')->where('transactions.kredit', $item->nama_akun)->join('transactions', 'general_journals.id_transaksi', '=', 'transactions.id')->first();

                if($saldo_awal_debit->nominal_debit != null || $posting_debit != null){
                    $total_saldo_debit = $saldo_awal_debit->nominal_debit + $posting_debit->pdebit - $posting_kredit->pkredit;
                    $total_saldo_kredit= false;
                    // echo $total_saldo_debit;
                } elseif ($saldo_awal_kredit->nominal_kredit != null || $posting_kredit != null){
                    $total_saldo_kredit= $saldo_awal_kredit->nominal_kredit + $posting_kredit->pkredit - $posting_debit->pdebit;
                    $total_saldo_debit = false;
                    echo $total_saldo_kredit;
                } else{
                    $total_saldo_kredit= false;
                    $total_saldo_debit = false;
                }
            }

            

        
            
        // return view('sahl.laba-rugi', compact('penjualan', 'pembelian', ''));
    }

}
