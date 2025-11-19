<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id('id_warga');

            // TIPE DATA INT (bukan BIGINT) agar COCOK dgn 'id_user'
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users');

            $table->foreignId('id_rt')->constrained('rt', 'id_rt'); // Nyambung ke 'rt'

            $table->string('alamat_lengkap')->nullable();
            $table->string('no_hp')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
