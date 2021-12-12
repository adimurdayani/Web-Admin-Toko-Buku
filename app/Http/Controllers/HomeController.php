<?php

namespace App\Http\Controllers;

use App\Costumer;
use App\Produk;
use App\Transaksi;
use App\TransaksiDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $costumer = Costumer::count();
        $transaksi = Transaksi::count();
        $user = User::count();
        $transaksi_id = Transaksi::where('toko_id', $id)->count();
        $transaksi_menunggu = Transaksi::whereStatus('MENUNGGU')->count();
        $transaksi_pembeli = Transaksi::whereStatus('SELESAI')->count();
        $transaksi_batal = Transaksi::whereStatus('BATAL')->count();
        $produk = Produk::where('toko_id', $id)->limit(5)->get();
        $total_penjualan = Transaksi::all();
        $total = $total_penjualan->sum('total_transfer');
        $transaksihistori = Transaksi::where('toko_id', $id)->limit(5)->orderBy('id', 'desc')->get();
        return view('index', compact(
            'costumer', 
            'transaksi_id',
            'transaksi', 
            'transaksi_menunggu', 
            'user',
            'transaksi_pembeli', 
            'produk',
            'transaksihistori',
            'total',
            'transaksi_batal'));
    }
}
