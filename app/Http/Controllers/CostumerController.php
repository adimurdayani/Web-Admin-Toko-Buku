<?php

namespace App\Http\Controllers;

use App\Costumer;
use App\Transaksi;
use Illuminate\Http\Request;

class CostumerController extends Controller
{
    public function index()
    {
        $kostumer = Costumer::all();
        $costumer = Costumer::count();
        $transaksi = Transaksi::count();
        return view('costumer.index', compact('kostumer','costumer', 'transaksi'));
    }
    public function hapus($id)
    {
        Costumer::where('id', $id)->delete();
        return redirect()->back();
    }
}
