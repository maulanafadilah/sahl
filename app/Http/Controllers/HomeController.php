<?php

namespace App\Http\Controllers;

use App\Account;
use App\Asset;
use App\Capital;
use App\Debt;
use App\General_journal;
use App\Superbook;
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
        // $penjualan = Account::select('nama_akun')->where('nama_akun', 'LIKE', '%Penjualan%')->orderBy("nomor_akun")->groupBy('nama_akun')->limit('3')->get();
        // $penjualan2 = Account::find('1');
        // return $penjualan2;
        // $merge = $penjualan->merge($penjualan);
        // return $merge;
        // foreach($penjualan as $item){
        //     $nominal_penjualan = Superbook::select('total_saldo', 'nama_akun')->where('nama_akun', $item->nama_akun)->get();
        //     // echo $nominal_penjualan;
        // }
        // // $nominal_penjualan = toJson($nominal_penjualan);

        // // $penjualan_bersih = array_sum($item_penjualan->total_saldo);
        // return $nominal_penjualan;
        // $pembelian = Account::select('nama_akun')->where('nama_akun', 'LIKE', '%Pembelian%')->orderBy("nomor_akun")->get();

        // return view('sahl.laba-rugi');
    }

}
