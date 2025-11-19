<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_iurans', function (Blueprint $table) {
            $table->id('id_iuran');
            $table->string('nama_iuran');
            $table->decimal('default_jumlah', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_iurans');
    }
};
