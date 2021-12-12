<?php

namespace App\Http\Controllers;

use App\Costumer;
use App\Transaksi;
use App\TransaksiDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $costumer = Costumer::count();
        $transaksi = Transaksi::count();
        $transaksiMenunggu = Transaksi::with('user')->where('toko_id', $id)->whereStatus('MENUNGGU')->orderBy('id', 'desc')->get();
        $transaksiDiproses = Transaksi::where('status', 'NOT LIKE', "%MENUNGGU%")->orderBy('id', 'desc')->get();
        return view('transaksi.index', compact('transaksiMenunggu', 'transaksiDiproses', 'costumer', 'transaksi'));
    }

    public function batal($id)
    {
        $transaksi  = Transaksi::where('id', $id)->first();
        // $this->pushNotif("Transaksi dibatalkan", "Transaksi produk ".$transaksi->details[0]->produk->name.", telah dibatalkan",  $transaksi->user->fcm);
        $transaksi->update([
                'status' => "BATAL"
            ]);
        return redirect()->back();
    }

    public function proses($id)
    {
        $transaksi  = Transaksi::with(['details.produk'])->where('id', $id)->first();
        // $this->pushNotif("Transaksi sedang diproses", "Transaksi produk ".$transaksi->details[0]->produk->name.", telah diproses",  $transaksi->user->fcm);
        $transaksi->update([
                'status' => "PROSES"
            ]);
        return redirect()->back();
    }

    public function kirim($id)
    {
        $transaksi  = Transaksi::with(['details.produk'])->where('id', $id)->first();
        // $this->pushNotif("Proses Pengiriman", "Transaksi produk ".$transaksi->details[0]->produk->name.", sedang dalam pengiriman",  $transaksi->user->fcm);
        $transaksi->update([
                'status' => "DIKIRIM"
            ]);
        return redirect()->back();
    }

    public function selesai($id)
    {
        $transaksi  = Transaksi::with(['details.produk'])->where('id', $id)->first();
        // $this->pushNotif("Transaksi selesai", "Transaksi produk ".$transaksi->details[0]->produk->name.", telah diterima",  $transaksi->user->fcm);
        $transaksi->update([
                'status' => "SELESAI"
            ]);
        return redirect()->back();
    }

    public function hapus($id)
    {
        Transaksi::where('id', $id)->delete();
        return redirect()->back();
    }

    public function detail($id)
    {
        $costumer = Costumer::count();
        $transaksi = Transaksi::count();
        $transaksi_id = Transaksi::where('id', $id)->first();
        $detailtransaksi = TransaksiDetail::where('transaksi_id', $id)->with('produk')->get();
        // return json_decode($detailtransaksi);
        // $detailtransaksi = TransaksiDetail::find($id);
        return view('transaksi.detail', compact('detailtransaksi', 'costumer', 'transaksi', 'transaksi_id'));
    }

    public function pushNotif($title, $message, $mfcm)
    {
        
    }
}
