<?php

namespace App\Http\Controllers;

use App\Costumer;
use App\Produk;
use App\Transaksi;
use Illuminate\Http\Request;

class ProduksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        $costumer = Costumer::count();
        $transaksi = Transaksi::count();
        return view('produk.produk', compact('produk', 'costumer', 'transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $costumer = Costumer::count();
        $transaksi = Transaksi::count();
        return view('produk.t_produk', compact('transaksi', 'costumer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'image' => 'required',
            'stok' => 'required',
            'berat' => 'required'
        ]);

        $file = '';
        if ($request->image->getClientOriginalName()) {
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName  = date('mYdHs') . rand(1, 999) . '-' . $file;
            $request->image->storeAs('public/produk', $fileName);
        } else {

            toast('Produk berhasil ditambahkan', 'success');
        }
        Produk::create(array_merge($request->all(), [
            'image' => $fileName
        ]));
        toast('Produk berhasil ditambahkan', 'success');
        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::where('id', $id)->first();
        $costumer = Costumer::count();
        $transaksi = Transaksi::count();
        return view('produk.e_produk', compact('produk', 'transaksi', 'costumer'));
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
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'image' => 'required',
            'stok' => 'required',
            'berat' => 'required'
        ]);

        $file = '';
        if ($request->image->getClientOriginalName()) {
            $file = str_replace(' ', '', $request->image->getClientOriginalName());
            $fileName  = date('mYdHs') . rand(1, 999) . '-' . $file;
            $request->image->storeAs('public/produk', $fileName);
        }
        $data = array(
            'nama_produk' => $request->get('nama_produk'),
            'harga' => $request->get('harga'),
            'deskripsi' => $request->get('deskripsi'),
            'kategori' => $request->get('kategori'),
            'image' => $fileName,
            'stok' => $request->get('stok'),
            'berat' => $request->get('berat'),
            'toko_id' => $request->get('toko_id'),
            'nama_toko' => $request->get('nama_toko')
        );
        Produk::where('id', $id)->update($data);
        toast('Produk berhasil diupdate', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produk::where('id', $id)->delete();
        return redirect()->back();
    }
}
