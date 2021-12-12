<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kostumer_id',
        'kode_payment',
        'kode_trx',
        'total_item',
        'total_harga',
        'kode_unik',
        'status',
        'kurir',
        'name',
        'phone',
        'detail_lokasi',
        'metode',
        'deskripsi',
        'expired_at',
        'jasa_pengiriman',
        'ongkir',
        'total_transfer',
        'bank', 
        'bukti_transfer',
        'toko_id'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, "transaksi_id", "id");
    }
    public function costumer()
    {
        return $this->belongsTo(Costumer::class, "kostumer_id", "id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, "toko_id", "id");
    }
}
