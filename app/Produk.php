<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'nama_produk', 
        'harga', 
        'deskripsi', 
        'kategori', 
        'image', 
        'stok', 
        'berat', 
        'toko_id'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
