<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('merchant_order_id')->unique()->nullable();
            $table->integer('fk_user_id');
            $table->integer('fk_promo_id')->nullable();
            $table->integer('fk_paket_mst');
            $table->integer('fk_paket_kategori');
            $table->integer('fk_paket_subkategori');
            $table->mediumText('payment_url')->nullable();
            $table->string('reference')->nullable();
            $table->bigInteger('harga_normal');
            $table->bigInteger('harga');
            $table->integer('status')->default('0')->comment = '0 = Pending ; 1 = Success ; 2 = Failed ; 3 = Expired';
            $table->string('bukti')->nullable();
            $table->datetime('expired');
            $table->datetime('aktif_sampai');
            $table->integer('created_by');
            $table->datetime('created_at');
            $table->integer('updated_by')->nullable();
            $table->datetime('updated_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
