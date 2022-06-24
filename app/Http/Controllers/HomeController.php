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
        return view('dashboard', compact('asset', 'capital', 'debt'));
    }
    public function buku_besar(Request $request)
    {
        return view('sahl.buku_besar.buku_besar');
    }
}
