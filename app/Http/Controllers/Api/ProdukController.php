<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;

class ProdukController extends Controller
{
    public function index($kategori)
    {
        $produk  = Produk::where('kategori', $kategori)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'produk' => $produk
        ]);
    }

    public function terbaru($kategori)
    {
        $produk  = Produk::where('kategori', $kategori)->limit(4)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'produk' => $produk
        ]);
    }

    public function terlaris($kategori)
    {
        $produk  = Produk::where('kategori', $kategori)->limit(4)->get();
        return response()->json([
            'success' => 1,
            'message' => 'Data sukses',
            'produk' => $produk
        ]);
    }
}
