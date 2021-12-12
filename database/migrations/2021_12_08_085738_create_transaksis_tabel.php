<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('toko_id');
            $table->string('kode_payment',128);
            $table->string('kode_trx',128);
            $table->integer('total_item');
            $table->bigInteger('total_harga');
            $table->integer('kode_unik');
            $table->string('status',128);
            $table->string('kurir',128);
            $table->string('phone',128);
            $table->string('name',128);
            $table->text('detail_lokasi');
            $table->text('deskripsi');
            $table->string('metode',128);
            $table->string('expired_at');
            $table->string('jasa_pengiriman', 128);
            $table->integer('ongkir');
            $table->bigInteger('total_transfer');
            $table->string('bank', 128);
            $table->string('bukti_transfer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
