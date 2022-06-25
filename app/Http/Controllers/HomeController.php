<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Capital;
use App\Debt;
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
    public function buku_besar(Request $request)
    {
        return view('sahl.buku_besar.buku_besar');
    }
}
