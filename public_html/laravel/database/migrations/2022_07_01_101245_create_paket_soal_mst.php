<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketSoalMst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_soal_mst', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->boolean('tryout');
            $table->datetime('mulai')->nullable();
            $table->datetime('selesai')->nullable();
            $table->mediumText('banner')->nullable();
            $table->integer('jenis_penilaian')->default('1');
            $table->integer('bagi_jawaban')->default('1')->comment = '1=Bagi ; 0=Jangan Bagi';
            $table->integer('acak_soal')->default('1')->comment = '1=Ya ; 0=Tidak';
            $table->integer('sertifikat')->nullable()->default('1')->comment = '1=Ada ; 0=Tidak Ada';
            $table->integer('kkm');
            $table->integer('waktu')->comment = 'Menit';
            $table->integer('total_soal')->default('0');
            $table->mediumText('ket')->nullable();
            $table->string('kode')->nullable();
            $table->mediumText('pengumuman')->nullable();
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
        Schema::dropIfExists('paket_soal_mst');
    }
}
