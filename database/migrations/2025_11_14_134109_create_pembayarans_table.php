<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('id_pembayaran');

            $table->foreignId('id_warga')->constrained('wargas', 'id_warga');
            $table->foreignId('id_iuran')->constrained('jenis_iurans', 'id_iuran');

            // TIPE DATA INT (bukan BIGINT) agar COCOK dgn 'id_user'
            $table->unsignedInteger('dicatat_oleh');
            $table->foreign('dicatat_oleh')->references('id_user')->on('users');

            $table->dateTime('tanggal_bayar');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->integer('periode_bulan');
            $table->integer('periode_tahun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
