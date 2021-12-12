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
        $this->pushNotif("Transaksi dibatalkan", "Transaksi produk " . $transaksi->details[0]->produk->nama_produk . ", telah dibatalkan",  $transaksi->costumer->fcm);
        $transaksi->update([
            'status' => "BATAL"
        ]);
        return redirect()->back();
    }

    public function proses($id)
    {
        $transaksi  = Transaksi::with(['details.produk'])->where('id', $id)->first();
        $this->pushNotif("Transaksi sedang diproses", "Transaksi produk " . $transaksi->details[0]->produk->nama_produk . ", telah diproses",  $transaksi->costumer->fcm);
        $transaksi->update([
            'status' => "PROSES"
        ]);
        return redirect()->back();
    }

    public function kirim($id)
    {
        $transaksi  = Transaksi::with(['details.produk'])->where('id', $id)->first();
        $this->pushNotif("Proses Pengiriman", "Transaksi produk " . $transaksi->details[0]->produk->nama_produk . ", sedang dalam pengiriman",  $transaksi->costumer->fcm);
        $transaksi->update([
            'status' => "DIKIRIM"
        ]);
        return redirect()->back();
    }

    public function selesai($id)
    {
        $transaksi  = Transaksi::with(['details.produk'])->where('id', $id)->first();
        $this->pushNotif("Transaksi selesai", "Transaksi produk " . $transaksi->details[0]->produk->nama_produk . ", telah diterima",  $transaksi->costumer->fcm);
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
        return view('transaksi.detail', compact('detailtransaksi', 'costumer', 'transaksi', 'transaksi_id'));
    }

    public function pushNotif($title, $message, $mfcm)
    {
        $mData = [
            'title' => $title,
            'body' => $message
        ];

        $fcm[] = $mfcm;

        $payload = [
            'registration_ids' => $fcm,
            'notification' => $mData
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Content-type: application/json",
                "Authorization: key=AAAApfAhH-w:APA91bF9wqof5ZPlRM-XSMNEm5R9kXYmFfGzvwX5vCEX66TR_QU4FxRPqc6QNb1BghoiTItDCbbIn3zf740y7sEZzx8FzrZbZqHvp0wCRAkTGXN_ILE3UMEmOs_sqb5n_y5JnuyhXBwi"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = [
            'success' => 1,
            'message' => "Push notif success",
            'data' => $mData,
            'firebase_response' => json_decode($response)
        ];
        return $data;
    }
}
